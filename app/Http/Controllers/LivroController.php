<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Exception;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $livros = Livro::orderBy('titulo')->get();

            return view('livros.index', [
                'livros' => $livros
            ]);
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('livros.form-create');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if (!$request->titulo) {
                throw new Exception('O campo "Título" não foi informado');
            }

            if (!$request->isbn) {
                throw new Exception('O campo "ISBN" não foi informado');
            }

            if (!$request->nome_autor) {
                throw new Exception('O campo "Nome do Autor" não foi informado');
            }

            if (!$request->ano_lancamento) {
                throw new Exception('O campo "Ano de lançamento" não foi informado');
            }

            if (!is_numeric($request->ano_lancamento)) {
                throw new Exception('Formato do campo "Ano de Lançamento" é incompatível');
            }

            $livro = Livro::create([
                'titulo'            => $request->titulo,
                'isbn'              => $request->isbn,
                'nome_autor'        => $request->nome_autor,
                'ano_lancamento'    => $request->ano_lancamento
            ]);

            if (!$livro) {
                throw new Exception('Não foi possível cadastrar os dados do livro');
            }

            return redirect()
                ->back()
                ->with('success', 'Livro "' . $livro->titulo . '" cadastrado com sucesso');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        try {
            return view('livros.form-edit', [
                'livro' => $livro
            ]);
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        try {

            if (!$request->titulo) {
                throw new Exception('O campo "Título" não foi informado');
            }

            if (!$request->isbn) {
                throw new Exception('O campo "ISBN" não foi informado');
            }

            if (!$request->nome_autor) {
                throw new Exception('O campo "Nome do Autor" não foi informado');
            }

            if (!$request->ano_lancamento) {
                throw new Exception('O campo "Ano de lançamento" não foi informado');
            }

            if (!is_numeric($request->ano_lancamento)) {
                throw new Exception('Formato do campo "Ano de Lançamento" é incompatível');
            }

            $livro->update([
                'titulo'            => $request->titulo,
                'isbn'              => $request->isbn,
                'nome_autor'        => $request->nome_autor,
                'ano_lancamento'    => $request->ano_lancamento
            ]);

            if (!$livro) {
                throw new Exception('Não foi possível atualizar os dados do livro');
            }

            return redirect()
                ->back()
                ->with('success', 'Livro "' . $livro->titulo . '" atualizado com sucesso');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        try {
            if (!$livro->delete()) {
                throw new Exception('Não foi possível remover os dados do livro');
            }

            $response['error']   = false;
            $response['msg']     = 'Livro "'.$livro->titulo.'" foi removido com sucesso';
        } catch (Exception $ex) {
            $response['error']   = true;
            $response['msg']     = $ex->getMessage();
        } finally {
            return response()->json($response, 202);
        }
    }
}
