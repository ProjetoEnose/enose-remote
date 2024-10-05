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
            "success" => $request->session()->get("success", false),
            'newUserName' => $request->session()->get('newUserName')
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
            'success' => true,
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
        $user = Auth::user();

        return view("user.show", [
            "title" => "Informações do Usuário - $id",
            "pathToProfileImage" => "#",
            "userName" => $user->name,
            "userEmail" => $user->email,
            "userPassword" => $user->password,
            "userEmailValidated" => $user->email_verified_at
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
        $user = Auth::user();

        return view("user.settings", [
            "title" => "Editar Informações do Usuário - $id",
            "userName" => $user->name,
            "pathToProfileImage" => "#",
            "userEmail" => $user->email,
            "userPassword" => $user->password,
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
        dd($request);

        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profileImage' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Encontrar o usuário pelo ID
        $user = User::findOrFail($id);

        // Verificar se há uma imagem para upload
        if ($request->hasFile('profileImage')) {
            $imagePath = $request->file('profileImage')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Atualizar outros campos
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Salvar as mudanças
        $user->save();

        // Redirecionar ou retornar uma resposta de sucesso
        return redirect()->route('user.edit', $user->id)->with('success', 'Informações atualizadas com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
