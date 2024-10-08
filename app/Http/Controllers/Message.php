<?php

namespace App\Http\Controllers;

use App\Models\Message as ModelsMessage;
use Illuminate\Http\Request;
use App\Models\Discussion;

class Message extends Controller
{
    public function addMessage(Request $request){
        
        ModelsMessage::create([ 
            'contenu' => $request->contenu,
            'discussion_id' => $request->discusionId,
            'from' => $request->from,
            'message_type'=> $request->type
        ]); 
    } 

    public function getMessage(){
        $messages = ModelsMessage::all(); 
        $table=[]; 
        foreach($messages as $message) { 
              array_push($table, ['message'=> $message->contenu, 'id'=>$message->discussion_id,'from'=>$message->from]);  
        } 
        return $table;
   } 
    public function getLastMessage($id){ 
        $table = [];
        $messages = ModelsMessage::where('discussion_id', $id)->get();
        $number = count($messages); 
        array_push($table, ['message' => $messages[$number-1]->contenu, 'from' => $messages[$number-1]->from ]);

        return $table;
    }
    public function getUnseenMessage(){
        $messages = ModelsMessage::where('discussion_id', 2)->where('sent',0)->get();
        $unseen = count($messages);

        return $unseen;
    }   
}
