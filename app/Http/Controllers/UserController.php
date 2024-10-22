<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        // Valida os dados antes de continuar
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|in:true,false', // Valida o campo is_admin
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Forneça um endereço de e-mail válido.',
            'email.unique' => 'Esse e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ]);

        // Converte o valor de is_admin para booleano
        $validatedData['is_admin'] = $request->input('is_admin') === 'true';

        User::create($validatedData); // O mutator de 'password' irá hash automaticamente

        return redirect()->back()->with([
            'successOnInsert' => true,
            'newUserName' => $request->only('name')["name"]
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
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profileImage' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Forneça um endereço de e-mail válido.',
            'profileImage.image' => 'O arquivo deve ser uma imagem.',
            'profileImage.mimes' => 'A imagem deve ser do tipo: jpg, png, jpeg ou gif.',
            'profileImage.max' => 'A imagem não deve ter mais de 2048 kilobytes.',
        ]);


        // Redirecionar ou retornar uma resposta de sucesso
        return redirect()->back()->with('success', 'Informações atualizadas com sucesso.');
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
