<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Servicios",
 *     description="API para la gestión de servicios"
 * )
 */
class ServiciosApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/servicios",
     *     summary="Obtener todos los servicios",
     *     tags={"Servicios"},
     *     @OA\Response(response=200, description="Listado de servicios")
     * )
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Servicios obtenidos correctamente',
            'data' => Servicio::all()
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/servicios/{id}",
     *     summary="Obtener un servicio por ID",
     *     tags={"Servicios"},
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Response(response=200, description="Servicio encontrado"),
     *     @OA\Response(response=404, description="Servicio no encontrado")
     * )
     */
    public function show($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Servicio encontrado',
            'data' => $servicio
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/servicios",
     *     summary="Crear nuevo servicio",
     *     tags={"Servicios"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"nombre","precio"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="precio", type="number")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Servicio creado")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors'  => $validator->errors()
            ], 422);
        }

        $servicio = Servicio::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Servicio creado exitosamente',
            'data' => $servicio
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/servicios/{id}",
     *     summary="Actualizar servicio",
     *     tags={"Servicios"},
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Response(response=200, description="Servicio actualizado")
     * )
     */
    public function update(Request $request, $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:255',
            'precio' => 'numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $servicio->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Servicio actualizado correctamente',
            'data' => $servicio
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/servicios/{id}",
     *     summary="Eliminar servicio",
     *     tags={"Servicios"},
     *     @OA\Response(response=200, description="Servicio eliminado")
     * )
     */
    public function destroy($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado'
            ], 404);
        }

        $servicio->delete();

        return response()->json([
            'success' => true,
            'message' => 'Servicio eliminado correctamente'
        ], 200);
    }
}
