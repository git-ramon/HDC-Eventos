@extends('layouts.main')

@section('titulo', 'HDC Events')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td scropt="row">{{ $loop->index +1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->titulo }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                            <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon>Editar</a> 
                            <form action="/events/{{ $event->id }}" method="post">
                                @csrf 
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar </button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <p>Voce ainda nao tem eventos, <a href="/events/create">Criar Evento</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou Participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipantes) > 0)
    <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </thead>
            <tbody>
                @foreach($eventsAsParticipantes as $event)
                    <tr>
                        <td scropt="row">{{ $loop->index +1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->titulo }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                            <form action="/events/leave/{{ $event->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon> Sair do Evento
                                </button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Voce ainda nao esta participando de nenhum evento, <a href="/">Voltar a pagina inicial</a></p>
    @endif
</div>

@endsection
