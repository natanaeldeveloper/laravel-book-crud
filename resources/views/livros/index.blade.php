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
    <div class="col-md-12" style="display: flex;justify-content: flex-end;">
        <a href="{{ route('livro.create') }}" class="btn btn-success">Cadastrar Livro</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                LIVROS PUBLICADOS
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped" id="tabelaLivros">
                            <head>
                                <th>Título</th>
                                <th>ISBN</th>
                                <th>Nome do Autor</th>
                                <th>Ano de Lançamento</th>
                                <th class="center">Opções</th>
                            </head>
                            <tbody>
                                @foreach ($livros as $livro)
                                <tr data-id="{{ $livro->id }}">
                                    <td>{{ $livro->titulo }}</td>
                                    <td>{{ $livro->isbn }}</td>
                                    <td>{{ $livro->nome_autor }}</td>
                                    <td>{{ $livro->ano_lancamento }}</td>
                                    <td class="center">
                                        <div class="btn-group btn-group-xs">
                                            <button onclick="removerLivro({{ $livro->id }})" class="btn btn-danger" style="margin-right: 5px;">Remover</button>
                                            <a href="{{ route('livro.edit', ['livro' => $livro->id]) }}" class="btn btn-primary">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{ csrf_field() }}

@endsection

@section('scripts')
<script>

    const _token = $('input[name="_token"]').val()

    function removerLivro(livroId){

        if(confirm('Deseja mesmo remover os dados deste livro? \n\n Está ação excluirá os dados do livro permanetemente')) {
            
            const xhr = $.ajax({
                url: `/livros/${livroId}`,
                type: 'DELETE',
                data: { _token },
                error: function (xhr, status, msg) {
                    console.error(msg)   
                }
            })

            xhr.done(function(data) {
                const response = typeof data == 'string' ? JSON.parse(data) : data
                if(response.error) {
                    alert(response.msg)
                } else {
                    alert(response.msg)
                    $(`#tabelaLivros tbody tr[data-id=${livroId}]`).remove()
                } 
            })
        }
    }
</script>
@endsection