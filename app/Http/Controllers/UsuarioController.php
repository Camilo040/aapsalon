<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
class UsuarioController extends Controller
{
 public function index(Request $request)
 {
 $users = User::all();
 return view('usuario.index', compact('users'));
 }
 public function create()
 {
 return view('usuario.create');
 }
 public function store(Request $request)
 {
 $request->validate([
 'name' => 'required|string|max:255',
 'email' => 'required|email|unique:users',
 'password' => 'required|min:8',
 ]);
 User::create([
 'name' => $request['name'],
 'email' => $request['email'],
 'password' => Hash::make($request['password']),
 ]);
 return redirect('/usuario')->with('success', 'Usuario creado exitosamente');
 }
 public function show($id)
 {
 $user = User::find($id);
 return view('usuario.show', ['user' => $user]);
 }
 public function edit($id)
 {
 $user = User::find($id);
 return view('usuario.edit', ['user' => $user]);
 }
 public function update(Request $request, $id)
 {
 $request->validate([
 'name' => 'required|string|max:255',
 'email' => 'required|email|unique:users,email,' . $id,
 'password' => 'nullable|min:8',
 ]);
 $user = User::find($id);
 $user->name = $request->name;
 $user->email = $request->email;

 if ($request->password) {
 $user->password = Hash::make($request->password);
 }

        $user->update($request->only('nombre', 'correo', 'contraseña'));

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminada correctamente');
    }
}