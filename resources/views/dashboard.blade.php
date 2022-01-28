@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>
<div class="col-md10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    @else
    <p>Voce ainda nao tem eventos, <a href="/events/create">Criar Evento</a></p>
    @endif
</div>

@endsection
