<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class adminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filterByNome = $request->name ?? '';
        $filterByEstado = $request->estado ?? '0';

        $adminQuery = User::query();

        $userIds = User::where('bloqueado', $filterByEstado)->pluck('id');
        $adminQuery->whereIntegerInRaw('id', $userIds);

        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $adminQuery->whereIntegerInRaw('id', $userIds);
        }

        $admins = $adminQuery->where('tipo', '=', 'A')->paginate(10);

        return view('admins.index', compact('admins', 'filterByNome' ,'filterByEstado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = new User();

        return view('admins.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $formData = $request->validated();

        $defaultPassword = "123";

        $newadmin = User::create([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'password' => Hash::make($defaultPassword),
            'tipo' => 'A',
        ]);

        if ($request->hasFile('file_foto')) {

            $path = $request->file_foto->store('public/fotos');
            $newadmin->foto_url = basename($path);
            $newadmin->save();
        }

        $newadmin->sendEmailVerificationNotification();

        $url = route('admins.show', ['admin' => $newadmin]);
        $htmlMessage = "admin <a href='$url'>#{$newadmin->id}</a><strong>\"{$newadmin->name}\"</strong> foi criada com sucesso! Password: " . $defaultPassword;
        return redirect()->route('admins.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(User $admin): View
    {
        return view('admins.show', compact('admin'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(User $admin): View
    {
        return view('admins.edit', compact('admin'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(UserRequest $request, User $admin): RedirectResponse
    {
        $admin->update($request->validated());

        if ($request->hasFile('file_foto')) {

            if ($admin->foto_url) {
                Storage::delete('public/fotos/' . $admin->foto_url);
            }

            $path = $request->file_foto->store('public/fotos');
            $admin->foto_url = basename($path);
            $admin->save();
        }

        $url = route('admins.show', ['admin' => $admin]);
        $htmlMessage = "admin <a href='$url'>#{$admin->id}</a>
                        <strong>\"{$admin->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('admins.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(User $admin): RedirectResponse
    {
        try {
            $admin->delete();
            $this->destroy_foto($admin);
            $htmlMessage = "admin #{$admin->id}
                        <strong>\"{$admin->name}\"</strong> foi apagado com sucesso!";
            return redirect()->route('admins.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('admins.show', ['admin' => $admin]);
            $htmlMessage = "Não foi possível apagar o admin <a href='$url'>#{$admin->id}</a>
                        <strong>\"{$admin->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    public function destroy_foto(User $admin): RedirectResponse
    {
        if ($admin->foto_url) {
            Storage::delete('public/fotos/' . $admin->foto_url);
            $admin->foto_url = null;
            $admin->save();
        }
        return redirect()->route('admins.edit', ['admin' => $admin])
            ->with('alert-msg', 'Foto do admin "' . $admin->name . '" foi removida!')
            ->with('alert-type', 'success');
    }

    public function block_admin(User $admin): RedirectResponse
    {
        $admin->bloqueado = 1;
        $admin->save();

        return redirect()->route('admins.index', ['admin' => $admin])
            ->with('alert-msg', 'Admin "' . $admin->name . '" foi bloqueado!')
            ->with('alert-type', 'success');
    }
}
