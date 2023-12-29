<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;

//use http\Env\Request;

class PostController extends Controller
{
    public function index($id){
        return response()->json(["a"=>$id]);
    }
}
