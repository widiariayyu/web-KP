<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mjenisangkutan;

class mJenisangkutanController extends Controller
{
    public function seldata(Request $r)
    {
    	$term = trim($r->q);
        if (empty($term)) {
            $tags = Mjenisangkutan::all();
        }else {
            $tags = Mjenisangkutan::where('jenis', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->jenis];
        }
        return response()->json($formatted_tags);
    }
}
