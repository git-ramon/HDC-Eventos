<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index (){

        $search = request('search');

        if ($search) {
            $events = Event::where([
                ['titulo', 'like', '%'.$search.'%']
            ])->get();
        } else {
            $events = Event::all();
        }
    
        return view('welcome',['events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event;

        $event->titulo = $request->titulo;
        $event->date = $request->date;
        $event->cidade = $request->cidade;
        $event->privado = $request->privado;
        $event->descricao = $request->descricao;
        $event->items = $request->items;

        //image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestimage = $request->image;

            $extension = $requestimage->extension();

            $imagename = md5($requestimage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestimage->move(public_path('img/events'), $imagename);

            $event->image = $imagename;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event -> save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id){

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user -> EventsAsParticipantes -> toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $donoevento = User::where('id', $event->user_id)->first()->toArray();
    
        return view('events.show', ['event' => $event, 'donoevento' => $donoevento, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipantes = $user -> eventsAsParticipantes;

        return view('events.dashboard', ['events' => $events, 'eventsAsParticipantes' => $eventsAsParticipantes]);
    }

    public function destroy($id){

        Event::findOrFail($id)->delete('cascade');

        return redirect('/dashboard')->with('msg', 'Evento Excluido com sucesso !!!');
    }

    public function edit($id){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user->id){
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request){

        $data = $request->all();

        
        //image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestimage = $request->image;

            $extension = $requestimage->extension();

            $imagename = md5($requestimage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestimage->move(public_path('img/events'), $imagename);

            $data['image'] = $imagename;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Alterado com sucesso!');
    }

    public function joinEvent($id){

        $user = auth()->user();

        $user->eventsAsParticipantes()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença esta confirmada no evento! ' . $event->titulo);
    }

    public function leaveEvent($id){

        $user = auth()->user();

        $user->eventsAsParticipantes()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Voce Saiu do Evento com sucesso! ' . $event->titulo);
    }
}