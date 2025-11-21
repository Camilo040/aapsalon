<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
 /**
 * @OA\Post(
 * path="/auth/register",
 * summary="Registrar nuevo usuario",
 * description="Crea una nueva cuenta de usuario y retorna un token de acceso",
 * operationId="registerUser",
 * tags={"Autenticación"},
 * @OA\RequestBody(
 * required=true,
 * description="Datos del nuevo usuario",
 * @OA\JsonContent(
 * required={"name","email","password","password_confirmation"},
 * @OA\Property(property="name", type="string", example="Juan Pérez"),
 * @OA\Property(property="email", type="string", format="email", example="juan@ejemplo.com"),
 * @OA\Property(property="password", type="string", format="password", example="password123"),
 * @OA\Property(property="password_confirmation", type="string", format="password", example="password123"),
 * @OA\Property(property="role", type="string", enum={"admin","editor","usuario"}, example="usuario", description="Rol opcional, por defecto
'usuario'")
 * )
 * ),
 * @OA\Response(
 * response=201,
 * description="Usuario registrado exitosamente",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=true),
 * @OA\Property(property="message", type="string", example="Usuario registrado exitosamente"),
 * @OA\Property(
 * property="data",
 * type="object",
 * @OA\Property(
 * property="user",
 * type="object",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Juan Pérez"),
 * @OA\Property(property="email", type="string", example="juan@ejemplo.com"),
 * @OA\Property(property="role", type="string", example="usuario")
 * ),
 * @OA\Property(property="token", type="string", example="1|abcdef123456..."),
 * @OA\Property(property="token_type", type="string", example="Bearer")
 * )
 * )
 * ),
 * @OA\Response(
 * response=422,
 * description="Error de validación",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=false),
 * @OA\Property(property="message", type="string", example="Errores de validación"),
 * @OA\Property(property="errors", type="object")
 * )
 * )
 * )
 */
 public function register(Request $request)
 {
 $validator = Validator::make($request->all(), [
 'name' => 'required|string|max:255',
 'email' => 'required|string|email|max:255|unique:users',
 'password' => 'required|string|min:8|confirmed',
 'role' => 'nullable|in:admin,editor,usuario'
 ]);
 if ($validator->fails()) {
 return response()->json([
 'success' => false,
 'message' => 'Errores de validación',
 'errors' => $validator->errors()
 ], 422);
 }
 $user = User::create([
 'name' => $request->name,
 'email' => $request->email,
 'password' => Hash::make($request->password),
 'role' => $request->role ?? 'usuario',
 ]);
 // Crear token de acceso
 $token = $user->createToken('auth_token')->plainTextToken;
 return response()->json([
 'success' => true,
 'message' => 'Usuario registrado exitosamente',
 'data' => [
 'user' => [
 'id' => $user->id,
 'name' => $user->name,
 'email' => $user->email,
 'role' => $user->role,
 'created_at' => $user->created_at
 ],
 'token' => $token,
 'token_type' => 'Bearer'
 ]
 ], 201);
 }
 /**
 * @OA\Post(
 * path="/auth/login",
 * summary="Iniciar sesión",
 * description="Autentica un usuario y retorna un token de acceso",
 * operationId="loginUser",
 * tags={"Autenticación"},
 * @OA\RequestBody(
 * required=true,
 * description="Credenciales del usuario",
 * @OA\JsonContent(
 * required={"email","password"},
 * @OA\Property(property="email", type="string", format="email", example="juan@ejemplo.com"),
 * @OA\Property(property="password", type="string", format="password", example="password123")
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="Login exitoso",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=true),
 * @OA\Property(property="message", type="string", example="Login exitoso"),
 * @OA\Property(
 * property="data",
 * type="object",
 * @OA\Property(
 * property="user",
 * type="object",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Juan Pérez"),
 * @OA\Property(property="email", type="string", example="juan@ejemplo.com"),
 * @OA\Property(property="role", type="string", example="usuario")
 * ),
 * @OA\Property(property="token", type="string", example="2|ghijkl789012..."),
 * @OA\Property(property="token_type", type="string", example="Bearer")
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="Credenciales inválidas",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=false),
 * @OA\Property(property="message", type="string", example="Credenciales incorrectas")
 * )
 * )
 * )
 */
 public function login(Request $request)
 {
 $validator = Validator::make($request->all(), [
 'email' => 'required|email',
 'password' => 'required'
 ]);
 if ($validator->fails()) {
 return response()->json([
 'success' => false,
 'message' => 'Errores de validación',
 'errors' => $validator->errors()
 ], 422);
 }
 $user = User::where('email', $request->email)->first();
 if (!$user || !Hash::check($request->password, $user->password)) {
 return response()->json([
 'success' => false,
 'message' => 'Credenciales incorrectas'
 ], 401);
 }
 // Crear token de acceso
 $token = $user->createToken('auth_token')->plainTextToken;
 return response()->json([
 'success' => true,
 'message' => 'Login exitoso',
 'data' => [
 'user' => [
 'id' => $user->id,
 'name' => $user->name,
 'email' => $user->email,
 'role' => $user->role,
 ],
 'token' => $token,
 'token_type' => 'Bearer'
 ]
 ], 200);
 }
 /**
 * @OA\Post(
 * path="/auth/logout",
 * summary="Cerrar sesión",
 * description="Revoca el token actual del usuario autenticado",
 * operationId="logoutUser",
 * tags={"Autenticación"},
 * security={{"bearerAuth":{}}},
 * @OA\Response(
 * response=200,
 * description="Logout exitoso",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=true),
 * @OA\Property(property="message", type="string", example="Sesión cerrada exitosamente")
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="No autenticado"
 * )
 * )
 */
 public function logout(Request $request)
 {
 // Revocar el token actual
 $request->user()->currentAccessToken()->delete();
 return response()->json([
 'success' => true,
 'message' => 'Sesión cerrada exitosamente'
 ], 200);
 }
 /**
 * @OA\Post(
 * path="/auth/logout-all",
 * summary="Cerrar todas las sesiones",
 * description="Revoca todos los tokens del usuario autenticado",
 * operationId="logoutAllDevices",
 * tags={"Autenticación"},
 * security={{"bearerAuth":{}}},
 * @OA\Response(
 * response=200,
 * description="Todas las sesiones cerradas",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=true),
 * @OA\Property(property="message", type="string", example="Todas las sesiones cerradas exitosamente")
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="No autenticado"
 * )
 * )
 */
 public function logoutAll(Request $request)
 {
 // Revocar todos los tokens del usuario
 $request->user()->tokens()->delete();
 return response()->json([
 'success' => true,
 'message' => 'Todas las sesiones cerradas exitosamente'
 ], 200);
 }
 /**
 * @OA\Get(
 * path="/auth/profile",
 * summary="Obtener perfil del usuario",
 * description="Retorna la información del usuario autenticado",
 * operationId="getUserProfile",
 * tags={"Autenticación"},
 * security={{"bearerAuth":{}}},
 * @OA\Response(
 * response=200,
 * description="Perfil obtenido exitosamente",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="success", type="boolean", example=true),
 * @OA\Property(property="message", type="string", example="Perfil obtenido exitosamente"),
 * @OA\Property(
 * property="data",
 * type="object",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Juan Pérez"),
 * @OA\Property(property="email", type="string", example="juan@ejemplo.com"),
 * @OA\Property(property="role", type="string", example="usuario"),
 * @OA\Property(property="created_at", type="string", format="date-time"),
 * @OA\Property(property="active_tokens", type="integer", example=2, description="Número de tokens activos")
 * )
 * )
 * ),
 * @OA\Response(
 * response=401,
 * description="No autenticado"
 * )
 * )
 */
 public function profile(Request $request)
 {
 $user = $request->user();

 return response()->json([
 'success' => true,
 'message' => 'Perfil obtenido exitosamente',
 'data' => [
 'id' => $user->id,
 'name' => $user->name,
 'email' => $user->email,
 'role' => $user->role,
 'created_at' => $user->created_at,
 'active_tokens' => $user->tokens()->count()
 ]
 ], 200);
 }
 /**
 * @OA\Put(
 * path="/auth/profile",
 * summary="Actualizar perfil del usuario",
 * description="Actualiza la información del usuario autenticado",
 * operationId="updateUserProfile",
 * tags={"Autenticación"},
 * security={{"bearerAuth":{}}},
 * @OA\RequestBody(
 * required=true,
 * @OA\JsonContent(
 * @OA\Property(property="name", type="string", example="Juan Pérez Actualizado"),
 * @OA\Property(property="email", type="string", example="juan.nuevo@ejemplo.com"),
 * @OA\Property(property="current_password", type="string", example="password123", description="Requerido si se cambia la contraseña"),
 * @OA\Property(property="new_password", type="string", example="newpassword123", description="Nueva contraseña"),
 * @OA\Property(property="new_password_confirmation", type="string", example="newpassword123")
 * )
 * ),
 * @OA\Response(
 * response=200,
 * description="Perfil actualizado exitosamente"
 * ),
 * @OA\Response(
 * response=401,
 * description="No autenticado o contraseña actual incorrecta"
 * ),
 * @OA\Response(
 * response=422,
 * description="Error de validación"
 * )
 * )
 */
 public function updateProfile(Request $request)
 {
 $user = $request->user();
 $validator = Validator::make($request->all(), [
 'name' => 'sometimes|string|max:255',
 'email' => 'sometimes|email|unique:users,email,' . $user->id,
 'current_password' => 'required_with:new_password',
 'new_password' => 'sometimes|min:8|confirmed',
 ]);
 if ($validator->fails()) {
 return response()->json([
 'success' => false,
 'message' => 'Errores de validación',
 'errors' => $validator->errors()
 ], 422);
 }
 // Actualizar nombre y email si se proporcionan
 if ($request->has('name')) {
 $user->name = $request->name;
 }
 if ($request->has('email')) {
 $user->email = $request->email;
 }
 // Cambiar contraseña si se proporciona
 if ($request->has('new_password')) {
 if (!Hash::check($request->current_password, $user->password)) {
 return response()->json([
 'success' => false,
 'message' => 'La contraseña actual es incorrecta'
 ], 401);
 }

 $user->password = Hash::make($request->new_password);
 }
 $user->save();
 return response()->json([
 'success' => true,
 'message' => 'Perfil actualizado exitosamente',
 'data' => [
 'id' => $user->id,
 'name' => $user->name,
 'email' => $user->email,
 'role' => $user->role,
 ]
 ], 200);
 }
}