<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use DB;
use Datatables;

class rbacRoleController extends Controller
{
    public function index()
    {
        $datas = Role::where('id', '>', 0)->with('permissions')->get();
        $a = $datas->permissions;
        dd($a);
        return view('RBAC.role');
    }

    public function getdata()
    {
        $datas = Role::where('id', '>', 0)->with('permissions')->get();
        return Datatables::of($datas)
        ->addColumn('action', function ($data) {
            return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->addColumn('permission', function ($data){
            return $data->permission ? $data->permission->concact(['nama_permission']) : '';
        })
        ->make(true);
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Role::all();
        }else {
            $tags = Role::where('nama_role', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_role];
        }
        return response()->json($formatted_tags);
    }
}
