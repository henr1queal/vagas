<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use LaravelLegends\PtBrValidator\Rules\CelularComDdd;
use LaravelLegends\PtBrValidator\Rules\FormatoCnpj;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['required', 'string', 'max:100'],
            'cnpj' => ['required', new FormatoCnpj, 'unique:' . User::class],
            'phone' => ['required', new CelularComDdd, 'unique:' . User::class],
        ],[
            'cnpj.unique' => 'O CNPJ digitado já existe. Caso já tenha cadastro, efetue login, ou recupere sua senha. Caso seja uma responsável diferente por este CNPJ, envie um e-mail para contato@vagasmaceio.com.br e aguarde o nosso retorno.',
            'phone.unique' => 'O telefone/celular digitado já existe. Caso já tenha cadastro, efetue login, ou recupere sua senha. Se está trabalhando em uma outra empresa e está tentando cadastrar o número da conta anterior, envie um e-mail para contato@vagasmaceio.com.br e aguarde o nosso retorno.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_name' => $request->company_name,
            'cnpj' => $request->cnpj,
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
