<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FuncionariosController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'funcionario');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filterByNome = $request->name ?? '';
        $filterByEstado = $request->estado ?? '0';

        $funcionarioQuery = User::query();

        $userIds = User::where('bloqueado', $filterByEstado)->pluck('id');
        $funcionarioQuery->whereIntegerInRaw('id', $userIds);

        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $funcionarioQuery->whereIntegerInRaw('id', $userIds);
        }
        $funcionarios = $funcionarioQuery->where('tipo', '=', 'F')->paginate(10);
        return view('funcionarios.index', compact('funcionarios', 'filterByNome', 'filterByEstado' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $funcionario = new User();

        return view('funcionarios.create', compact('funcionario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $formData = $request->validated();

        $defaultPassword = "123";

        $newFuncionario = User::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'password' => Hash::make($defaultPassword),
            'tipo' => 'F',
        ]);

        if ($request->hasFile('file_foto')) {

            $path = $request->file_foto->store('public/fotos');
            $newFuncionario->foto_url = basename($path);
            $newFuncionario->save();
        }

        $newFuncionario->sendEmailVerificationNotification();

        $url = route('funcionarios.show', ['funcionario' => $newFuncionario]);
        $htmlMessage = "Funcionario <a href='$url'>#{$newFuncionario->id}</a><strong>\"{$newFuncionario->name}\"</strong> foi criada com sucesso! Password: " . $defaultPassword;
        return redirect()->route('funcionarios.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(User $funcionario): View
    {
        return view('funcionarios.show', compact('funcionario'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(User $funcionario): View
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(UserRequest $request, User $funcionario): RedirectResponse
    {
        $funcionario->update($request->validated());

        if ($request->hasFile('file_foto')) {

            if ($funcionario->foto_url) {
                Storage::delete('public/fotos/' . $funcionario->foto_url);
            }

            $path = $request->file_foto->store('public/fotos');
            $funcionario->foto_url = basename($path);
            $funcionario->save();
        }

        $url = route('funcionarios.show', ['funcionario' => $funcionario]);
        $htmlMessage = "Funcionario <a href='$url'>#{$funcionario->id}</a>
                        <strong>\"{$funcionario->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('funcionarios.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(User $funcionario): RedirectResponse
    {
        try {
            $funcionario->delete();
            $this->destroy_foto($funcionario);
            $htmlMessage = "funcionario #{$funcionario->id}
                        <strong>\"{$funcionario->name}\"</strong> foi apagado com sucesso!";
            return redirect()->route('funcionarios.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('funcionarios.show', ['funcionario' => $funcionario]);
            $htmlMessage = "Não foi possível apagar o funcionario <a href='$url'>#{$funcionario->id}</a>
                        <strong>\"{$funcionario->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function destroy_foto(User $funcionario): RedirectResponse
    {
        if ($funcionario->foto_url) {
            Storage::delete('public/fotos/' . $funcionario->foto_url);
            $funcionario->foto_url = null;
            $funcionario->save();
        }
        return redirect()->route('funcionarios.edit', ['funcionario' => $funcionario])
            ->with('alert-msg', 'Foto do funcionario "' . $funcionario->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function block_funcionario(User $funcionario): RedirectResponse
    {
        if ($funcionario->bloqueado == 1) {
            $funcionario->bloqueado = 0;
            $estado = "desbloqueado";
        } else {
            $funcionario->bloqueado = 1;
            $estado = "bloqueado";
        }

        $funcionario->save();

        return redirect()->route('funcionarios.index', ['funcionario' => $funcionario])
            ->with('alert-msg', 'Funcionario "' . $funcionario->name . '" foi ' . $estado . '!')
            ->with('alert-type', 'success');
    }
}
