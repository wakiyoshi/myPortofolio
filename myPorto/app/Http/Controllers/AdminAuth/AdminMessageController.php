<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;


class AdminMessageController extends Controller
{
    public function messageIndex(){
        $admin_id = Auth::guard('sanctum')->user()->id;
        $messages = Message::join('users','messages.user_id','=','users.id')
        ->where('admin_id',$admin_id)
        ->orderBy('messages.created_at','asc')
        ->get();
        return $messages;
    }
    public function messageShow($id){
        $admin_id = Auth::guard('sanctum')->user()->id;
        $messages = Message::where("admin_id",$admin_id)
        ->where("user_id",$id)
        ->orderBy('created_at','asc')
        ->get();
        return $messages;
    }
    public function messageCreate(Request $request){
        $admin_id = Auth::guard('sanctum')->user()->id;
        Message::create([
            'admin_id'=>$admin_id,
            'user_id' => $request->id,
            'admin_message'=>$request->text,
        ]);
        return response()->json(['message' => 'Message sent successfully'], 200);
    }
}
