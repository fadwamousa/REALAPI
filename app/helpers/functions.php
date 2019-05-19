<?php


  function apiResponse($status,$msg,$data=null){

    return response()->json(['data'=>$data , 'msg'=>$msg , 'status'=>$status]);

  }
