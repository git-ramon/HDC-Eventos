@extends('layouts.main')

@section('titulo', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Pesquisar Eventos</h1>
    <form action="/" method="GET">
        <input type="text" id="seach" name="search" class="form-control" placeholder="Procurar ...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Resultado da Busca: {{ $search }}</h2>
    @else
        <h2>Proximos Eventos</h2>
        <p class="subtitle">Veja os eventos dos proximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->titulo }}">
            <div class="card-body">
                <p class="card-date">{{ date(date('d/m/Y'), strtotime($event->date)) }}</p>
                <h5 class="card-title">{{ $event->titulo }}</h5>
                <p class="card-participantes">{{ count($event->users) }} Participantes</p>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Nao foi possivel encontrar nenhum evento com {{ $search }}! <a href="/"> Voltar para Dashboard </a></p>
        @elseif(count($events) == 0)
            <p>Nao ha Eventos Disponiveis</p>
        @endif
    </div>
</div>
@endsection