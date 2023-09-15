<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BuyController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::get('logout', 'logout');
    Route::get('refresh', 'refresh');
});

Route::middleware('jwt.auth')->group(function () {
    // Rutas protegidas
    Route::get('/facturas/{id_user}', [BillController::class, 'obtenerFacturasPorUsuario']);
    Route::get('/compras/{id_user}/{factura_id}', [BuyController::class, 'obtenerComprasPorFactura']);
});

