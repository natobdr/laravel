<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Pessoa;
use App\Models\Telefone;
use function Sodium\add;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $pessoa = Pessoa::with(['telefone','user','endereco'])->findOrFail($request->user()->id);
        //dd($pessoa);
        return view('profile.edit', [
            'user' =>  $pessoa
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->name = $request->name;
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        $pessoa = Pessoa::with(['telefone','user','endereco'])->findOrFail($request->user()->id);

        $pessoa->pes_nome = $request->name;
        $pessoa->save();

        $pessoa->telefone->updateOrCreate(
            ['id' => $request->user()->id],
            ['tel_cd_ddd' => trim(substr($request->phone,0,4)),
            'tel_nu_telefone' => trim(substr($request->phone,4)),
        ]);
        $pessoa->endereco->updateOrCreate(
            [
                'id' => $request->user()->id
            ],
            [
                'end_nm_logradouro' => $request->logradouro,
                'end_ds_cidade' => $request->cidade,
                'end_ds_estado' => $request->estado,
                'end_nu_imovel' => $request->numero,
                'end_nm_bairro' => $request->bairro,
                'end_nu_cep' => $request->cep,
                'end_nu_imovel' => $request->numero,
            ]);

        //dd($request->cidade.toSql());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
