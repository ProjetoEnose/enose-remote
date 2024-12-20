<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
            $pathNewImage = ProfileImage::saveImage($validatedData['profileImage']);

            try {
                if ($user->profileImage) {
                    ProfileImage::deleteFileImageOnDeleteRegister($user->profileImage->path);
                    $user->profileImage->path = $pathNewImage;
                    $user->profileImage->save();
                } else {
                    ProfileImage::create([
                        'path' => $pathNewImage,
                        'user_id' => $user->id
                    ]);
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with([
                    'errorOnUpdate' => true
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
        if ($user->profileImage) ProfileImage::deleteFileImageOnDeleteRegister($user->profileImage->path);
        $deleted = $user->delete();

        return redirect()->back()->with(
            [
                "successOnDelete" => $deleted,
                "userNameDeleted" => $deleted ? $user->name : null // Garante que o nome só seja enviado se o usuário for excluído
            ]
        );
    }
}
