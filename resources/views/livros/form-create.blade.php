@extends('layouts.app')

@section('styles')
@endsection

@section('content')

@if (session('success'))
   <div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
   </div> 
@endif

@if (session('error'))
   <div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
   </div> 
@endif

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                FORMULÁRIO DE CADASTRO
            </div>
            <form action="{{ route('livro.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" name="titulo" placeholder="Título" id="titulo" value="{{ old('titulo') }}">
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="isbn">ISBN:</label>
                                <input type="text" class="form-control" name="isbn" placeholder="ISBN" id="isbn" value="{{ old('isbn') }}">
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nomeAuthor">Nome do Autor:</label>
                                <input type="text" class="form-control" name="nome_autor" placeholder="Título" id="nomeAuthor" value="{{ old('nome_autor') }}">
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="anoLancamento">Ano de Lançamento:</label>
                                <input maxlength="4" class="form-control" name="ano_lancamento" placeholder="Ano de Lançamento" id="anoLancamento" value="{{ old('ano_lancamento') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12" style="display: flex; justify-content: flex-end;">
                            <a href="{{ route('livro.index') }}" class="btn btn-default" style="margin-right: 5px;">Voltar</a>
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection