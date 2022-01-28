@extends('layouts.main')

@section('titulo', 'Editando: ' .$event->titulo)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $event->titulo }}</h1><br>
    
    <form action="/events/update/{{ $event->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->titulo }}" class="img-preview">
        </div><br>
        <div class="form group">
            <label for="titulo">Evento:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do Evento" value="{{ $event->titulo }}">
        </div>
        <div class="form group">
            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        </div>
        <div class="form group">
            <label for="titulo">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Local do Evento" value="{{ $event->cidade }}">
        </div>
        <div class="form group">
            <label for="titulo">Evento Privado ou Gratuito:</label>
            <select id="privado" name="privado" class="form-control">
                <option value="0">Privado</option>
                <option value="1" {{ $event->private == 1 ? "selected= 'selected'" : "" }}>Gratuito</option>
            </select>
        </div>
        <div class="form group">
            <label for="titulo">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" placeholder="O  que vai acontecer no evento ?">{{ $event->descricao }}</textarea>
        </div>
        <div class="form group">
            <label for="titulo">Adicione items de infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja Gratis"> Cerveja Gratis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div><br>
        <input type="submit" class="btn btn-primary" value="Alterar Evento">
    </form>
</div>


@endsection