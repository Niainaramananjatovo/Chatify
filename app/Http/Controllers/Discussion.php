<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Discussion as ModelsDiscussion;
use App\Models\Message as ModelsMessage;

class Discussion extends Controller
{
   public function addConversation($id_to){
        ModelsDiscussion::create([ 
            'user1'=>$id_to,
            'user2'=>Auth::user()->id
        ]);
   } 
   
   public function getDiscussion(){
    $discussions=ModelsDiscussion::where('user1',Auth::user()->id)->orwhere('user2',Auth::user()->id)->get();
    $table=[];
    foreach($discussions as $discussion){
        if($discussion->user1==Auth::user()->id){
           $user= User::find($discussion->user2);
           array_push($table,['user'=> $user,'id_Discussion'=>$discussion->id]);
        }else{
           $user= User::find($discussion->user1);
           array_push($table,['user'=>$user,'id_Discussion'=>$discussion->id]);
        }
    }
    return $table;
   }

}