<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UploadModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;
class MemberController extends Controller
{
    protected function memberHome()
    {
        $deptfollower = 1;
        $data['member'] = User::where('userid', Auth::user()->userid)->first();
        $data['pic'] = User::where('userid', $data['member']->rekomendasi)->first();
        $data['follower'] = User::all()->where('rekomendasi', $data['member']->userid)
        ->where('userid','!=', $data['member']->userid);
        $data['bukti'] = UploadModel::where('userid',Auth::user()->userid)->get();
        $data['count'] = $data['follower']->count();
        $data['deptfollower'] = $deptfollower;
        return view('member.memberdetail', $data);
    }

    protected function member()
    {
        $data['member'] = User::orderBy('id', 'desc')->get();
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

    protected function updateMember1(Request $request)
    {
        
        $data = [
            'name' => $request->name,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ];
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $rs = User::where('id', Auth::user()->id)
        ->update($data);
        if($rs){
            return redirect('member/profile')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil memperbarui !',
            ]);
        }else{
            return redirect('member/profile')->with([
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
        $data['follower'] = User::where('rekomendasi',$userid)->where('userid','!=',$userid)->get();
        $data['bukti'] = UploadModel::where('userid',$userid)->get();
        $data['count'] = $data['follower']->count();
        return view('admin.memberdetail', $data);
    }

    protected function memberInfo1($deptfollower,$userid)
    {
        $deptfollower = $deptfollower + 1;
        if($deptfollower > 3){
            $data['member'] = User::where('userid', $userid)->first();
            $data['pic'] = User::where('userid', $data['member']->rekomendasi)->first();
            $data['follower'] = null;
            $data['bukti'] = null;
            $data['count'] = User::where('rekomendasi',$userid)->where('userid','!=',$userid)->get()->count();
            $data['deptfollower'] = $deptfollower;
        }else{
            $data['member'] = User::where('userid', $userid)->first();
            $data['pic'] = User::where('userid', $data['member']->rekomendasi)->first();
            $data['follower'] = User::where('rekomendasi',$userid)->where('userid','!=',$userid)->get();
            $data['bukti'] = UploadModel::where('userid',$userid)->get();
            $data['count'] = $data['follower']->count();
            $data['deptfollower'] = $deptfollower;
        }
        
        return view('member.memberdetail', $data);
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
