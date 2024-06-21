<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use PDF;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($order_id)
    {
        try {
            // Aquí puedes usar $order_id para consultar los datos específicos del pedido
            $data[] = Pedido::with(['venta', 'user', 'ciudad'])->find($order_id);

            if (!$data) {
                return response()->json([
                    'message' => 'Pedido no encontrado',
                ], 404);
            }

            // Define la vista que se usará para el PDF, pasando el pedido específico
            $pdf = PDF::loadView('pdf.pdf_bill', compact('data'));

            // Define el tamaño de la página
            $pdf->setPaper([0, 0, 283, 567], 'portrait'); // 20x10 cm en puntos (1 cm = 28.35 puntos)

            // Descarga el PDF
            return $pdf->download('documento_pedido_' . $order_id . '.pdf');

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al generar el PDF',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}