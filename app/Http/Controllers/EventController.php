<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
    //
    public function index(){
        $events = Event::all();
        return $events->toJson();
    }
    public function store(Request $req){
    $validatedData = $req->validate([
        'Title' => 'required|string',
        'Description' => 'required|string',
        'Date' => 'required|date',
        'Time' => 'required|string',
        'Location' => 'required|string',
        'Capacity' => 'required|integer',
        'Type' => 'required|string|in:workshop,seminar,conference,other',
        'Status' => 'required|string|in:draft,published,canceled',
        'Registration_deadline' => 'required|date_format:Y-m-d H:i:s',
        'Image' => 'nullable|image|size:1024||dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
    ]);

    $result = Event::create($validatedData);

    if ($result) {
        return ["Result" => "Saved"];
    } else {
        return ["Result" => "Error"];
    }
}
    public function update(Request $req){
        $event = Event::find($req->id);
        $validatedData = $req->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'capacity' => 'required|integer',
            'type' => 'required|string|in:workshop,seminar,conference,other',
            'status' => 'required|string|in:draft,published,canceled',
            'registration_deadline' => 'required|date_format:Y-m-d H:i:s'
        ]);
        $event->title=$req->title;
        $event->description=$req->description;
        $event->date=$req->date;
        $event->time=$req->time;
        $event->location=$req->location;
        $event->capacity=$req->capacity;
        $event->type=$req->type;
        $event->status=$req->status;
        $event->registration_deadline=$req->registration_deadline;
        $event->id=$req->id;
        $result = $event->save();
            if ($result){
                return ["Result" => "Event updated"];
            }
            else{
                return ["Result" => "Update Failed"];
            }

    }

    public function delete($id){
        $event = Event::find($id);
        $result = $event->delete();
        if($result){
            return ["Result" => "Event deleted"];
        }
        else{
            return ["Result"=> "The event is not deleted"];
        }
        
    }

}
