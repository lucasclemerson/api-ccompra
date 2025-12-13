<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            // Tenta conectar ao banco de dados para um health check mais completo
            DB::connection()->getPdo(); 
            return response()->json([
                'status' => 'ok',
                'database' => 'connected',
                'app_status' => 'running',
                'name_app' => 'CCompra API - Health Check',
                'version' => '1.0.0',
                'environment' => app()->environment(),
                'timestamp' => now()->toDateTimeString(),
                'by' => 'CEO - Clemerson Lucas de Oliveira'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'database' => 'disconnected',
                'app_status' => 'degraded',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}