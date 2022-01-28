@extends('layouts.main')

@section('titulo', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu Evento</h1><br>
    
    <form action="/events" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div><br>
        <div class="form group">
            <label for="titulo">Evento:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do Evento">
        </div>
        <div class="form group">
            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form group">
            <label for="titulo">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Local do Evento">
        </div>
        <div class="form group">
            <label for="titulo">Evento Privado ou Gratuito:</label>
            <select id="privado" name="privado" class="form-control">
                <option value="0">Privado</option>
                <option value="1">Gratuito</option>
            </select>
        </div>
        <div class="form group">
            <label for="titulo">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" placeholder="O  que vai acontecer no evento ?"></textarea>
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
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>


@endsection