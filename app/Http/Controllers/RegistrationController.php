<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //
    public function index(){
        $registered = Registration::all();
        return $registered;
        
    }

    public function store(Request $req){
        $validatedData = $req->validate([
            'user_id' => 'required|numeric',
            'event_id' => 'required|numeric',
        ]);

        $registered = Registration::create($validatedData);
        $result = $registered->save();

        if($result){
            return ["Result"=>"Registered Successfully"];
        }else{
            return ["Result"=>"Registration Failed"];
        }
    }

    public function update(Request $req){
        $registered = Registration::find($req->id);
        $validatedData = $req->validate([
            'user_id' => 'required|numeric',
            'event_id' => 'required|numeric',
        ]);
        $registered->update($validatedData);
        $registered->save();
        return ["Result"=> "Updated Successfully"];
    }

    public function delete($id){
        $registered = Registration::find($id);
        $registered->delete();
        return ["Result"=> "Deleted Successfully"];
    }

}
