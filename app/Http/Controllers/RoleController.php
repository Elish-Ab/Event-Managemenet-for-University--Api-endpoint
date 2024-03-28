<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function index(){
        $role = Role::all();
        return $role;
    }
    
    public function store(Request $req) {
       
        $validatedData = $req->validate([
            'user_id' => 'required|numeric',
            'Rating' => 'required|integer',
            'description' => 'required|max:250',
        ]);
        $role = Role::create($validatedData);

        $result = $role->save();
        if($result){
            return ['message' => 'Role Saved!'];
        }else{  
            return ['message' => 'Role Saving failed...'];
        }
    }


    public function update(Request $req) {
        $role = Role::find($req->id);
        $validatedData = $req->validate([
            'user_id' => 'required|numeric',
            'Rating' => 'required|integer',
            'description' => 'required|text',
        ]);
        $role->update($validatedData);
        $result = $role->save();
        if($result){
            return ['message'=> 'Role updated'];
        }
        else{
            return ['message' => 'update failed'];
        }
        
    }

    public function delete($id){
        $role = Role::find($id);
        $result = $role->delete();
        if($result){
            return ["message"=>"Role deleted "];
        }
        else{
            return ["message" => "deletion failed"];
        }
    }
}
