<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result,$message){
        $respose = [
          'success'=>true,
          'data' =>$result,
          'message'=>$message
        ];
        return response()->json($respose,200);
    }

    public function sendError($error,$errormessage=[],$code=404){
        $respose = [
          'success'=>false,
          'message'=>$error
        ];

        if(!empty($errormessage)){
            $respose['data'] = $errormessage;
        }
        return response()->json($respose,$code);
    }
}
