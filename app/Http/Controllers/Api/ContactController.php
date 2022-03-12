<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request){

        $path = $request->file->store('uploads');

        return response()->json([
            'success' => true,
            'result' => $path

        ]);
    }
}
