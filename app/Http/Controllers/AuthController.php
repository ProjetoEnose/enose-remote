<?php

namespace App\Http\Controllers;

use App\Exceptions\PasswordMismatchException;
use App\Http\Requests\UpdateAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* exibe a página de informações sobre a confirmação do e-mail */
        return view('auth', [
            'title' => 'Confirmação de Email',
            'userEmail' => Auth::user()->email,
        ]);
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
    public function show($id) {}

    public function sendEmailCofirmation() {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('auth.edit', [
            'title' => 'Alterar senha',
            'user' => User::find($id),
            'passwordUpdated' => session()->get('passwordUpdated')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthRequest $request, $id)
    {
        $passwords = $request->validated();
        $sessionData = ['passwordUpdated' => false];

        try {
            $sessionData['passwordUpdated'] = User::updatePasswordUser(
                passwords: $passwords,
                user: User::findOrFail($id)
            );
            return redirect()->back()->with($sessionData);
        } catch (PasswordMismatchException $e) {
            $sessionData['error'] = 'A senha atual fornecida não é válida.';
            return redirect()->back()->with($sessionData);
        } catch (\Throwable $th) {
            return redirect()->back()->with($sessionData);
        }
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
