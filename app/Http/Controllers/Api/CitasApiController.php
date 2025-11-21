<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Citas",
 *     description="API para la gestión de citas"
 * )
 */
class CitasApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/citas",
     *     summary="Obtener todas las citas",
     *     tags={"Citas"},
     *     @OA\Response(response=200, description="Listado de citas")
     * )
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Citas obtenidas correctamente',
            'data' => Cita::all()
        ]);
    }

    /**
     * @OA\Get(
     *     path="/citas/{id}",
     *     summary="Obtener una cita por ID",
     *     tags={"Citas"},
     *     @OA\Parameter(name="id", in="path", required=true),
     *     @OA\Response(response=200, description="Cita encontrada"),
     *     @OA\Response(response=404, description="No encontrada")
     * )
     */
    public function show($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cita encontrada',
            'data' => $cita
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/citas",
     *     summary="Crear una nueva cita",
     *     tags={"Citas"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"fecha","hora","usuario_id"},
     *             @OA\Property(property="fecha", type="string"),
     *             @OA\Property(property="hora", type="string"),
     *             @OA\Property(property="usuario_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Cita creada")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'hora' => 'required',
            'usuario_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $cita = Cita::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cita creada correctamente',
            'data' => $cita
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/citas/{id}",
     *     summary="Actualizar una cita",
     *     tags={"Citas"},
     *     @OA\Response(response=200, description="Actualizada")
     * )
     */
    public function update(Request $request, $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha' => 'date',
            'hora' => 'string',
            'usuario_id' => 'integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $cita->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cita actualizada correctamente',
            'data' => $cita
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/citas/{id}",
     *     summary="Eliminar cita",
     *     tags={"Citas"},
     *     @OA\Response(response=200, description="Eliminada")
     * )
     */
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'success' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $cita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cita eliminada correctamente'
        ], 200);
    }
}