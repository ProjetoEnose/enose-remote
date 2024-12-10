<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /* injetando o middleware que permisionará o acesso a alguns recursos */
    public function __construct()
    {
        // Aplica o middleware apenas para as rotas que precisam de verificação
        $this->middleware('check.if.admin')->only(['create', 'store', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $allUsers = User::all(['name', 'email', 'is_admin', 'created_at']);

        return view("user/admin.create", [
            "title" => "Gerir Usuários - Administrador - " . Auth::id(),
            "allUsers" => $allUsers,
            "successOnInsert" => $request->session()->get("successOnInsert", false),
            'newUserName' => $request->session()->get('newUserName'),
            'successOnDelete' => $request->session()->get('successOnDelete'),
            'userNameDeleted' => $request->session()->get('userNameDeleted')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        // Converte o valor de is_admin para booleano
        $validatedData['is_admin'] = $validatedData['is_admin'] === 'true';

        User::create($validatedData); // O mutator de 'password' irá hash automaticamente

        return redirect()->back()->with([
            'successOnInsert' => true,
            'newUserName' => $validatedData["name"]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("user.show", [
            "title" => "Informações do Usuário - $id",
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("user.edit", [
            "title" => "Editar Informações do Usuário - $id",
            'user' => Auth::user(),
            'successOnUpdate' => session()->get('successOnUpdate')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // Valida os dados recebidos
        $validatedData = $request->validated();

        // Recupera o usuário pelo ID
        $user = User::findOrFail($id);
        $user->update($validatedData);

        /* Lógica de armazenamento de fotos de usuário */
        if (isset($validatedData['profileImage'])) {
            // Gera um nome único para o arquivo e armazena-o
            $profileImage = $validatedData['profileImage'];
            $fileName = rand(0, 9999) . "-{$profileImage->getClientOriginalName()}";
            $path = $profileImage->storeAs('uploads', $fileName);
            $path = "storage/" . $profileImage->storeAs('public/uploads', $fileName);


            // Acessa o relacionamento diretamente para obter a imagem associada
            $existingProfileImage = $user->profileImage;

            if ($existingProfileImage) {
                // Recupera o caminho do arquivo existente
                $existingFilePath = $existingProfileImage->path;

                // Exclui o arquivo do servidor, se existir
                if (Storage::exists($existingFilePath)) {
                    Storage::delete($existingFilePath);
                }

                // Atualiza o registro existente com o novo caminho
                $existingProfileImage->update(['path' => $path]);
            } else {
                // Cria um novo registro se não houver uma imagem associada
                ProfileImage::create([
                    'path' => $path,
                    'user_id' => $user->id
                ]);
            }
        }

        // Redireciona ou retorna uma resposta de sucesso
        return redirect()->back()->with([
            'successOnUpdate' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $deleted = $user->delete();

        return redirect()->back()->with(
            [
                "successOnDelete" => $deleted,
                "userNameDeleted" => $deleted ? $user->name : null // Garante que o nome só seja enviado se o usuário for excluído
            ]
        );
    }
}
