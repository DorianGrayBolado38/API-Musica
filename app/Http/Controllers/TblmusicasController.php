<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\tblmusicas;

class TblmusicasController extends Controller
{
    // Construir o CRUD.

    // Mostrar todos os registros da tabela músicas
    // Crud -> Read (leitura) Select/Visualizar
    public function index()
    {
        $regBook = tblmusicas::all();
        $contador = $regBook->count();

        return response()->json([
            'musicas' => $regBook,
            'count' => $contador
        ]);
    }

    // Mostrar um tipo de registro específico
    // Crud -> Read (leitura) Select/Visualizar
    // A função show busca o ID e retorna se a música foi localizada por ID.
    public function show(string $id)
    {
        $regBook = tblmusicas::find($id);

        if ($regBook) {
            return response()->json($regBook);
        } else {
            return response()->json(['message' => 'Música não localizada.'], Response::HTTP_NOT_FOUND);
        }
    }

    // Cadastrar registros
    // Crud -> Create (criar/cadastrar)
    public function store(Request $request)
    {
        $regBook = $request->all();

        $validator = Validator::make($regBook, [
            'nomeMusica' => 'required|string|max:255',
            'generoMusica' => 'required|string|max:100',
            'albumMusica' => 'required|string|max:255', // Corrigido para string
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $regBookCad = tblmusicas::create($regBook);

        return response()->json($regBookCad, Response::HTTP_CREATED);
    }

    // Alterar registros
    // Crud -> update (alterar)
    public function update(Request $request, string $id)
    {
        \Log::info('Update request received for ID: ' . $id);

        $regBook = $request->all();

        $validator = Validator::make($regBook, [
            'nomeMusica' => 'required|string|max:255',
            'generoMusica' => 'required|string|max:100',
            'albumMusica' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed for update: ', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $regBookBanco = tblmusicas::find($id);

        if (!$regBookBanco) {
            \Log::error('Music not found with ID: ' . $id);
            return response()->json(['message' => 'Música não encontrada.'], Response::HTTP_NOT_FOUND);
        }

        $regBookBanco->nomeMusica = $regBook['nomeMusica'];
        $regBookBanco->generoMusica = $regBook['generoMusica'];
        $regBookBanco->albumMusica = $regBook['albumMusica'];

        $retorno = $regBookBanco->save();

        if ($retorno) {
            \Log::info('Music updated successfully with ID: ' . $id);
            return response()->json($regBookBanco, Response::HTTP_OK);
        } else {
            \Log::error('Error updating music with ID: ' . $id);
            return response()->json(['message' => 'Erro: Música não foi atualizada.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Deletar os registros
    // Crud -> delete (apagar)
    public function destroy(string $id)
    {
        $regBook = tblmusicas::find($id);

        if (!$regBook) {
            return response()->json(['message' => 'Música não encontrada.'], Response::HTTP_NOT_FOUND);
        }

        $regBook->delete();

        return response()->json(['message' => 'Música deletada com sucesso.'], Response::HTTP_NO_CONTENT);
    }

    // Crud
    // C reate
    // r ead
    // u pdate
    // d elete
}
