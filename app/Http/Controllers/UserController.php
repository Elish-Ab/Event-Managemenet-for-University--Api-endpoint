<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    //

    public function index(){
       
            $user = new UserCollection(User::all());
        
            return $user;
    
    }
    public function show($id){
            $user = new UserResource(User::findOrFail($id)) ;
        
            return $user;
    }
    public function comment($id){
        $users = User::find($id);
        $result = $users->comments;
        return $result;
    }
    public function event($id){
        $users = User::find($id);
        $result = $users->events();
        return $result;
    }

    public function store(Request $req){
        $user = new User();
        $user->name= $req->name;
        $user->email= $req->email;
        $user->password= $req->password;
        $result = $user->save();
        if($result){
            return ["Result" => "Saved SuccessFully"];
        }
        else{
            return ["Result" => "Error Occurred while saving "];

        }
    }

    public function update(Request $req){
        $user = User::find($req->id);
        $user->name= $req->name;
        $user->email= $req->email;
        $user->password= $req->password;
        $result = $user->save();
        if($result){
            return ["Result"=> "Updated Successfully"];
        }
        else{
            return ["Result"=>"Update failed"];
        }
    }

    public function delete($id){
        $user = User::find($id);
        $result = $user->delete();
        if($result){
            return ["Result"=> "Deleted"];
        }
        else{
            return ["Result"=>"Delete failed"];
        }
    }
}
