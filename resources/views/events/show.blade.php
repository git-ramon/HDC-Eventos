@extends('layouts.main')

@section('titulo', $event->titulo)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->titulo }}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->titulo }}</h1>
            <p class="event-cidade"><ion-icon name="location-outline"></ion-icon>{{ $event->cidade }}</p>
            <p class="events-participantes"><ion-icon name="people-outline"></ion-icon>{{ count($event->users) }} Participantes</p>
            <p class="event-owner"><ion-icon name="star-outline"></ion-icon>{{ $donoevento['name'] }}</p><br>
            @if(!$hasUserJoined)
                <form action="/events/join/{{ $event->id }}" method="post">
                    @csrf
                    <a href="/events/join/{{ $event->id }}" class="btn btn-primary" id="event-submit" 
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    Confirmar Presença
                    </a>
                </form>
            @else
                <p class="already-joined-msg">Voce ja esta participando deste evento</p>
            @endif
            <h3>O Vento conta com:</h3>
            <ul id="items-list">
                @foreach ($event->items as $item)
                    <li><ion-icon name="play-outline"></ion-icon><span>{{ $item }}</span></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-12" id="descricao-container">
            <h3>Sobre o Evento</h3>
            <p class="event-descricao">{{ $event->descricao }}</p>
        </div>
    </div>
</div>

@endsection