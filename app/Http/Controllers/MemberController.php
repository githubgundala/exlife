<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;
class MemberController extends Controller
{
    protected function memberHome()
    {
        $data['member'] = User::where('userid', Auth::user()->userid)->first();
        $data['pic'] = User::where('userid', $data['member']->rekomendasi)->first();
        $data['follower'] = User::all()->where('rekomendasi', $data['member']->userid)
        ->where('userid','!=', $data['member']->userid);
        $data['count'] = $data['follower']->count();
        return view('member.memberdetail', $data);
    }

    protected function member()
    {
        $data['member'] = User::all();
        return view('admin.member',$data);
    }
    protected function createMember(Request $request)
    {
        $datus = [
            'name' => $request->name,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'rekomendasi' => $request->rekomendasi,
            'jenis_member' => $request->jenis_member,
            'userid' => $request->username,
            'password' => Hash::make($request->password),
        ];
        
        $user = User::create($datus);
        if($user){
            return redirect('admin/member')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil menambah !',
            ]);
        }else{
            return redirect('admin/member')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-danger',
                'message' => 'Gagal menambah !',
            ]);
        }
    }
    protected function deleteMember(Request $request)
    {
        $rs = User::destroy($request->id);
        if($rs){
            return redirect('admin/member')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil menghapus !',
            ]);
        }else{
            return redirect('admin/member')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-danger',
                'message' => 'Gagal meghapus !',
            ]);
        }
    }
    protected function updateMember(Request $request)
    {
        
        $data = [
            'name' => $request->name,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'rekomendasi' => $request->rekomendasi,
            'jenis_member' => $request->jenis_member,
            'userid' => $request->username,
        ];
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $rs = User::where('id', $request->id)
        ->update($data);
        if($rs){
            return redirect('admin/member')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil memperbarui !',
            ]);
        }else{
            return redirect('admin/member')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-danger',
                'message' => 'Gagal memperbarui !',
            ]);
        }
    }

    protected function memberInfo($userid)
    {
        $data['member'] = User::where('userid', $userid)->first();
        $data['pic'] = User::where('userid', $data['member']->rekomendasi)->first();
        $data['follower'] = User::all()->where('rekomendasi', $data['member']->userid)
        ->where('userid','!=', $data['member']->userid);
        $data['count'] = $data['follower']->count();
        return view('admin.memberdetail', $data);
    }

    public function checkusername(Request $request)
    {
        if(User::where('userid', $request->username)->exists()) {
            $response = false;
          } else {
            $response = true;
          }
          echo json_encode($response);
    }
    public function checkemail(Request $request)
    {
        if(User::where('email', $request->email)->exists()) {
            $response = false;
        }else {
            $response = true;
        }
          echo json_encode($response);
    }
}
