use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClothingController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('clothes', ClothingController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
