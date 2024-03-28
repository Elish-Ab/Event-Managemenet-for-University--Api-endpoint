<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    //
    public function index(){
        $feedback = Feedback::all();
        return $feedback;
    }
    
    public function store(Request $req) {
       
        $validatedData = $req->validate([
            'user_id' => 'required|numeric',
            'event_id' => 'required|numeric',
            'Rating' => 'required|integer',
        ]);
        $feedback = Feedback::create($validatedData);

        $feedback->save();
      
        return ['message' => 'Feedback Saved!'];
      
      }

    public function update(Request $req) {
        $feedback = Feedback::find($req->id);
        $validatedData = $req->validate([
            'event_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'Rating' => 'required|integer',
        ]);
        $feedback->update($validatedData);
        $result = $feedback->save();
        if($result){
            return ['message'=> 'feedback updated'];
        }
        else{
            return ['message' => 'update failed'];
        }
        
    }

    public function delete($id){
        $feedback = Feedback::find($id);
        $result = $feedback->delete();
        if($result){
            return ["message"=>"feedback deleted "];
        }
        else{
            return ["message" => "deletion failed"];
        }
    }
}