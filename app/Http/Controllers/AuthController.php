<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view("login");
    }

     /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->route('auth.index')->with('error', $validator->errors()->all());
        }

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials);
        if ($authenticated) {
            $request->session()->regenerate();

            return redirect()->route('tasks.index')->with('success', 'Login realizado com sucesso!');
        }

        return redirect()->route('auth.index')->with('error', 'E-mail ou senha incorretos!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('auth.index')->with('success', 'Logout realizado com sucesso!');
    }

    /**
     * Valid if login was sent.
     */
    private function validator($data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'O E-mail é obrigatório',
            'email.email' => 'Você deve inserir um email valido ',
            'password.required' => 'A Senha é obrigatória',
        ]);
    }
}
