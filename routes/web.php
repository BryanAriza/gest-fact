<?php

use App\Http\Livewire\Dash;
use App\Http\Livewire\PosController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\CustomerController;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\SalesController;
use App\Http\Controllers\ExportController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\ProfileController;
use App\Http\Livewire\PasswordController;
use App\Http\Livewire\ReportVentasController;




Route::get('/', function () {

    return view('auth.login');
});



Auth::routes();


Route::middleware(['auth'])->group(function () {

    Route::get('/home', Dash::class);
    Route::get('/dashboard', Dash::class);

    Route::group(['middleware' => ['role_or_permission:ADMIN|Config_Index|User_Index|Role_Index|Permission_Index|Asignar_Index']], function () {
      
        //Route::get('/home', UsersController::class);
        Route::get('/users', UsersController::class);
        Route::get('/roles', RolesController::class);
        Route::get('/permisos', PermisosController::class);
        Route::get('/asignar', AsignarController::class);  

    });

    Route::group(['middleware' => ['role_or_permission:ADMIN|Gest_Index|Product_Index|Category_Index']], function () {

        Route::get('/products', ProductsController::class);
        Route::get('/categories', CategoriesController::class);
    });

    Route::group(['middleware' => ['role_or_permission:ADMIN|FACTURADOR|Customer_Index']], function () {

        Route::get('/clientes', CustomerController::class);
    
    });

    Route::group(['middleware' => ['role_or_permission:ADMIN|FACTURADOR|Sales_Index']], function () {

        Route::get('/productosVenta', SalesController::class);
        //Route::get('/home', SalesController::class);
        Route::get('/ventaPos', PosController::class);
    
    });

    
    
    Route::group(['middleware' => ['role_or_permission:ADMIN|FACTURADOR|Reports_Index']], function () {

        Route::get('/reporVentas', ReportVentasController::class);

        //reportes EXCEL
        Route::get('/reportProduct/excel/', [ExportController::class, 'reportProducts']);
        Route::get('/reportProduct/excel/{f1}', [ExportController::class, 'reportProducts']);
        Route::get('/reportProduct/excel/{f1}/{f2}', [ExportController::class, 'reportProducts']);

        //reportes PDF
        Route::get('reportProduct/pdf/', [ExportController::class, 'reportPdfProduc']);
        Route::get('reportProduct/pdf/{f1}', [ExportController::class, 'reportPdfProduc']);
        Route::get('reportProduct/pdf/{f1}/{f2}', [ExportController::class, 'reportPdfProduc']);

        Route::get('/reportCategory/excel/', [ExportController::class, 'reportCategory']);
        Route::get('/reportCategory/excel/{f1}', [ExportController::class, 'reportCategory']);

        //reportes PDF
        Route::get('reportCategory/pdf/', [ExportController::class, 'reportPdfCate']);
        Route::get('reportCategory/pdf/{f1}', [ExportController::class, 'reportPdfCate']);

        Route::get('/reportCliente/excel/', [ExportController::class, 'reportCustomer']);
        Route::get('/reportCliente/excel/{f1}', [ExportController::class, 'reportCustomer']);
        
        Route::get('/reportSales/excel/', [ExportController::class, 'reportSales']);
        Route::get('/reportSales/excel/{f1}', [ExportController::class, 'reportSales']);
        Route::get('/reportSales/excel/{f1}/{f2}', [ExportController::class, 'reportSales']);
        Route::get('/reportSales/excel/{f1}/{f2}/{f3}', [ExportController::class, 'reportSales']);
        

        Route::get('/download-invoice/{document}/{date}/{id_header}', function ($document, $date, $id_header) {
            $filePath = public_path('facturas/factura_' . $document . '_' . $date . '_' . $id_header . '.pdf');
        
            if (!file_exists($filePath)) {
                abort(404, 'La factura no se encontró.');
            }
        
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="factura_' . $document . '.pdf"',
            ]);
        });
        
    });

    Route::get('/profile', ProfileController::class);
    Route::get('/password', PasswordController::class);
        
});


