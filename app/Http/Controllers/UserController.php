<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view("user", [
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

        return view("settings", [
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
