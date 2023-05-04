<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsuariController extends Controller
{

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = Usuari::where('username', $username)->first();

        if ($user) {
            if ($password === $user->contrasenya) {
                Auth::login($user);
                return redirect('/inici');
            }
        }

        return redirect('/')->with('error', 'Usuari i/o contrasenya incorrectes');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function contrasenya(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'new_password' => 'required|string',
        ]);

        $usuari = Usuari::find($request->input('user_id'));
        if (!$usuari) {
            return back()->withErrors(['error' => 'Usuario no encontrado.']);
        }

        $usuari->contrasenya = $request->input('new_password');
        $usuari->save();

        return redirect()->route('gestioUsuaris')->with('success', 'Contrasenya modificada correctament!');

        return redirect()->route('gestioUsuaris')->withErrors(['error' => "No s'ha pogut modificar la contrasenya."]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = Usuari::paginate(5);

        return view('gestioUsuaris', ['usuaris' => $usuaris]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $usuaris = Usuari::where('nom', 'like', "%$search%")
            ->orWhere('cognoms', 'like', "%$search%")
            ->paginate(5);

        return view('gestioUsuaris', ['usuaris' => $usuaris]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'cognoms' => 'required',
            'username' => 'required|unique:usuaris,username',
            'contrasenya' => 'required'
        ], [
            'required' => 'El camp :attribute es obligatori.',
            'unique' => 'El :attribute ja existeix'
        ]);

        $usuari = new Usuari;
        $usuari->nom = $request->nom;
        $usuari->cognoms = $request->cognoms;
        $usuari->username = $request->username;
        $usuari->contrasenya = $request->contrasenya;
        $usuari->tipus_usuaris_id = $request->tipus_usuaris_id;
        $usuari->save();

        return redirect()->route('gestioUsuaris')->with('success', 'Usuari creat correctament!');

        return redirect()->route('gestioUsuaris')->withErrors(['error' => 'Datos incorrectos, revisar datos introducidos']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuari = Usuari::find($id);
        return view('modificarUsuari', ['usuari' => $usuari]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuari = Usuari::find($id);
        $usuari->nom = $request->input('nom');
        $usuari->cognoms = $request->input('cognoms');
        $usuari->username = $request->input('username');
        $usuari->tipus_usuaris_id = $request->input('tipus_usuaris_id');

        if ($request->filled('contrasenya')) {
            $usuari->contrasenya = $request->input('contrasenya');
        }

        $usuari->save();

        return redirect()->route('gestioUsuaris')->with('success', 'Usuari modificat correctament');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuari = Usuari::find($id);
        $usuari->delete();
        return redirect()->route('gestioUsuaris')->with('success', 'Usuari eliminat correctament.');
    }
}
