<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\User;
use DB;
use Illuminate\Validation\Rule;
use Validator;

class rbacUserController extends Controller
{
    public function index()
    {
        return view('RBAC.user');
    }

    public function getdata()
    {
    	$datas = User::with('roles')->get();
        return Datatables::of($datas)
        ->addColumn('action', function ($data) {
            return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            		<a id="btnreset" data-toggle="modal" data-target="#modal-reset" class="btn btn-xs btn-warning"><i class="fa fa-repeat"></i> PWD</a>';
        })
        ->make(true);
    }

    public function validasi(Request $r)
    {
        // if (!empty($jeniskendaraan)) {
        //     $el = array('id' => $id, 'jeniskendaraan' => $jeniskendaraan);
        //     $validatedData = Validator::make($el, [
        //         'jeniskendaraan' => [Rule::unique('mjeniskendaraans')->ignore($id)],
        //     ]);
        //     if ($validatedData->passes()) {
        //         return response()->json('boleh');
        //     }
        // }
        return response()->json('gakboleh');
    }

    public function store(Request $r)
    {
        DB::beginTransaction();
        try {
            $data = User::create(['name' => $r->name, 'username' => $r->username, 'password' => bcrypt($r->username)]);
            $data->assignRole($r->role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->action('rbacUserController@index')->with('alert-danger','Data User Gagal Ditambah.');
        }
        event(new UserRegistrationEvent($data));
        return redirect()->action('rbacUserController@index')->with('alert-success','Data User '.$data->username.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = User::find($id);
        DB::beginTransaction();
        try {
            $data->update(['name' => $r->name, 'username' => $r->username]);
            DB::table('role_user')->where('user_id', $id)->delete();
            $data->assignRole($r->role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->action('rbacUserController@index')->with('alert-danger','Data User '.$data->username.' Gagal Diubah.');
        }
        return redirect()->action('rbacUserController@index')->with('alert-success','Data User '.$data->username.' Berhasil Diubah.');
    }

    public function reset(Request $r)
    {
        $data = User::find($r->id);
        $data->update(['password' => bcrypt($r->username)]);
        return redirect()->action('rbacUserController@index')->with('alert-success','User '.$data->username.' Berhasil Reset Password.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = User::all();
        }else {
            $tags = User::where('name', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }
        return response()->json($formatted_tags);
    }
}
