<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("login", [
            "title" => "Fazer Login",
            'showModal' => $request->session()->get('showModal', false),
        ]);
    }

    /**
     * Authenticate the user.
     */
    public function auth(Request $request)
    {
        // Validar os campos recebidos
        $credentials = $request->only(["email", "password"]);

        // Buscar o usuário pelo e-mail
        $user = User::where('email', $credentials['email'])->first();

        // Verificar se o usuário existe e se a senha corresponde
        if ($user && $user->password === $credentials['password']) {
            // Autenticar manualmente o usuário
            Auth::login($user);

            // Regenerar a sessão
            $request->session()->regenerate();

            // Redirecionar para a rota protegida ou padrão
            return redirect()->intended("dashboard");
        }

        // Senha ou e-mail incorretos
        return redirect()->back()->with("showModal", true);
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login.index");
    }
}
