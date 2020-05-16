<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Admin;
use App\User;
use App\UploadModel;

class AdminController extends Controller
{
    protected function home()
    {
        $data['count'] = User::all()->count();
        return view('admin.home',$data);
    }
    protected function admin()
    {
        $data['admin'] = Admin::all()->where('role', 1);
        $data['count'] = Admin::all()->count();
        return view('admin.admin',$data);
    }
    protected function deleteAdmin(Request $request)
    {
        $rs = Admin::destroy($request->id);
        if($rs){
            return redirect('admin/admin')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil menghapus !',
            ]);
        }else{
            return redirect('admin/admin')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-danger',
                'message' => 'Gagal meghapus !',
            ]);
        }
    }
    protected function updateAdmin(Request $request)
    {
        
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $rs = Admin::where('id', $request->id)
        ->update($data);
        if($rs){
            return redirect('admin/admin')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil memperbarui !',
            ]);
        }else{
            return redirect('admin/admin')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-danger',
                'message' => 'Gagal memperbarui !',
            ]);
        }
    }
    protected function uploadForm()
    {
        $data['member'] = User::all();
        $data['upload'] = UploadModel::all();
        return view('admin.upload',$data);
    }
    protected function upload(Request $request)
    {
      $file = $request->file('file');
      $nama_file = $file->getClientOriginalName();
      if(!Storage::exists('bukti')) {
        Storage::makeDirectory('ba_manual', 0777, true, true);
        $f = $file->move('bukti',$nama_file);
      }else{
        $f = $file->move('bukti',$nama_file);
      }

        $rs = UploadModel::create([
            'userid' => $request->member,
            'keterangan' => $request->keterangan,
            'foto' => $f->getPathname()
            ]);
            if($rs){
                return redirect('admin/upload/form')->with([
                    'alertstatus' => TRUE,
                    'tipe' => 'alert-success',
                    'message' => 'Berhasil upload !',
                ]);
            }else{
                return redirect('admin/upload/form')->with([
                    'alertstatus' => TRUE,
                    'tipe' => 'alert-danger',
                    'message' => 'Gagal upload !',
                ]);
            }
        
    }
    protected function uploadDelete($id)
    {
        $flight = UploadModel::find($id);
        if($flight->delete()){
            return redirect('admin/upload/form')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-success',
                'message' => 'Berhasil hapus !',
            ]);
        }else{
            return redirect('admin/upload/form')->with([
                'alertstatus' => TRUE,
                'tipe' => 'alert-danger',
                'message' => 'Gagal hapus !',
            ]);
        }
    }
}
