<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* exibe o formulário de login */
        return view("login", [
            "title" => "Fazer Login",
            'showModal' => $request->session()->get('showModal', false),
        ]);
    }

    public function auth(Request $request)
    {
        /* capturando as informações recebidas do formulário */
        $credentials = $request->only(["email", "password"]);

        $registrationExists = Auth::attempt($credentials);

        /* conferindo se há algum registro correspondente na base de dados */
        if ($registrationExists) {
            /* cria uma nova sessão para o usuário autentiado */
            $request->session()->regenerate();

            // Armazena informações do usuário na sessão, se necessário
            $user = Auth::user();

            $request->session()->put(
                [
                    'userName' => $user->name,
                    'pathToProfileImage' => sprintf("/images/avatars/%s.png", strtoupper($user->name[0])),
                    'isAdmin' => $user->is_admin,
                ]
            );

            /* redireciona para a rota que se estava tentando acessar, caso não haja uma tentativa anterior, assume a rota /home como padrão */
            return redirect()->intended("home");
        }

        /* em caso de não encontrar nenhum registro, redireciona de volta para a rota de exibição do form */
        return redirect()->back()->with("showModal", true);
    }

    public function logout(Request $request)
    {
        /* remove o usuário da sessão */
        Auth::logout();

        /* invalida a sessão atual, gerando uma nova */
        $request->session()->invalidate();
        /* gera um novo token @csrf*/
        $request->session()->regenerateToken();

        return redirect()->route("home.index");
    }
}
