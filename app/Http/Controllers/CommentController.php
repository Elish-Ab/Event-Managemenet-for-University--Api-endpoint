<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index(){
        $comment = Comment::all();
        return $comment;
    }
    
    public function store(Request $req) {
       
        $validatedData = $req->validate([
            'body' => 'required|string',

        ]);
        $comment = Comment::create($validatedData);

        $comment->save();
      
        return ['message' => 'Comment Saved!'];
      
      }

    public function update(Request $req) {
        $comment = Comment::find($req->id);
        $validatedData = $req->validate([
            'body' => 'required|string',
        ]);
        
        $comment->update($validatedData);
        $result = $comment->save();
        if($result){
            return ['message'=> 'Comment updated'];
        }
        else{
            return ['message' => 'update failed'];
        }
        
    }

    public function delete($id){
        $comment = Comment::find($id);
        $result = $comment->delete();
        if($result){
            return ["message"=>"Comment deleted "];
        }
        else{
            return ["message" => "deletion failed"];
        }
    }
}
