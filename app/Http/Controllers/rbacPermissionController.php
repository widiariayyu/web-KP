<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class rbacPermissionController extends Controller
{
    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = User::all();
        }else {
            $tags = User::where('nama_permission', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_permission];
        }
        return response()->json($formatted_tags);
    }
}
