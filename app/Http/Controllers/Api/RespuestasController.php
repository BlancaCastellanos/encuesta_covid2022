<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Respuesta;

//Version nueva
//use App\Models\Respuesta;

class RespuestasController extends Controller
{
    public function store(Request $request) {
        $respuesta = array();
        $respuesta['exito'] = false;

        $respuestaEncuesta = new Respuesta();

        //Si hay info, la asigna
        if ($request->input('id_tipo_usuario')) {
            $respuestaEncuesta->id_tipo_usuario =
            $request->input('id_tipo_usuario');
        } else { //Si no hay, regresa un 400
            $respuesta['mensaje'] = 
                "El valor id_tipo_usuario es obligatorio";
            return response()->json($respuesta,400);
        }
        
        if ($request->input('identificador')) {
            $respuestaEncuesta->identificador =
            $request->input('identificador');
        } else {
            $respuesta['mensaje'] = 
                "El valor identificador es obligatorio";
            return response()->json($respuesta,400);
        }

        if ($request->input('email')) {
            $respuestaEncuesta->email =
            $request->input('email');
        } else {
            $respuesta['mensaje'] = 
                "El valor email es obligatorio";
            return response()->json($respuesta,400);
        }

        if ($request->input('contacto_covid') != NULL) {
            $respuestaEncuesta->contacto_covid =
            $request->input('contacto_covid');
        } else {
            $respuesta['mensaje'] = 
                "El valor contacto_covid es obligatorio";
            return response()->json($respuesta,400);
        }
  
        if ($request->input('vacunado') != NULL) {
            $respuestaEncuesta->vacunado =
            $request->input('vacunado');
        } else {
            $respuesta['mensaje'] = 
                "El valor vacunado es obligatorio";
            return response()->json($respuesta,400);
        }
        $respuestaEncuesta->cadena_qr = "123456";
        
        try {
            if ($respuestaEncuesta->save()) {
                //sintomas
                $respuesta['exito'] = true;
                $respuesta['cadena_qr'] = 
                    $respuestaEncuesta->cadena_qr;
            }
        } catch (\Exception $e) {
            $respuesta["mensaje"] = 
                $e->getMessage();
            return response()->json($respuesta,500);
        }
        
        return $respuesta;
    }
}
