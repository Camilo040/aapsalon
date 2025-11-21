<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     title="API de Gestión de Usuarios",
 *     version="1.0.0",
 *     description="API RESTful para gestionar usuarios del sistema",
 * )
 *
 * @OA\Server(
 *     url="http://localhost/appsalon/public/api",
 *     description="Servidor Local de Desarrollo"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class UserApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Obtener lista de usuarios",
     *     tags={"Usuarios"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuarios obtenida exitosamente"
     *     )
     * )
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Usuarios obtenidos exitosamente',
            'data' => User::all()
        ]);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Obtener un usuario por ID",
     *     tags={"Usuarios"},
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Response(response=200, description="Usuario encontrado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Usuario encontrado',
            'data' => $user
        ]);
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     summary="Crear nuevo usuario",
     *     tags={"Usuarios"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Usuario creado"),
     *     @OA\Response(response=422, description="Error de validación")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente',
            'data'    => $user
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Actualizar usuario",
     *     tags={"Usuarios"},
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Response(response=200, description="Usuario actualizado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'string|max:255',
            'email'    => 'email|unique:users,email,' . $id,
            'password' => 'nullable|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors'  => $validator->errors()
            ], 422);
        }

        if ($request->name)     $user->name = $request->name;
        if ($request->email)    $user->email = $request->email;
        if ($request->password) $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente',
            'data'    => $user
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Eliminar usuario",
     *     tags={"Usuarios"},
     *     @OA\Response(response=200, description="Eliminado"),
     *     @OA\Response(response=404, description="Usuario no encontrado")
     * )
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }
}