<?php

use App\Http\Livewire\Dash;
use App\Http\Livewire\Select2;
use App\Http\Livewire\Component1;
use App\Http\Livewire\PosController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\CashoutController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\CitasController;
use App\Http\Livewire\PermisosController;
use App\Http\Controllers\ExportController;
use App\Http\Livewire\AgendaController;
use App\Http\Livewire\MasivoAgendaController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\ImportarDatosController;
use App\Http\Livewire\ConsolidadoController;
use App\Http\Controllers\ImportarExcelController;
use App\Http\Livewire\ProfileController;
use App\Http\Livewire\PasswordController;




Route::get('/', function () {

    return view('auth.login');
});



Auth::routes();


Route::middleware(['auth'])->group(function () {

    

    // Route::group(['middleware' => ['role_or_permission:SUPER|ADMIN|GESTOR|Home_Index|UploadPac_Index|UploadAgenda_Index']], function () {
    //     Route::resource('/importar', ImportarExcelController::class)->only(['index', 'store']);
    //     Route::get('/importAgenda', CitasController::class);
        
    // });

    // Route::group(['middleware' => ['role_or_permission:SUPER|ADMIN|GESTOR|Citas_Index|Pac_Index|Agenda_Index']], function () {
    //     Route::get('/home', PacientesController::class);
    //     Route::get('/informePaciente', PacientesController::class);
    //     Route::get('/informeAgenda', AgendaController::class);
        
    // });
    // Route::group(['middleware' => ['role_or_permission:SUPER|ADMIN|GESTOR|UploadCitas_Index']], function () {
    //     Route::get('/agendaMasiva', MasivoAgendaController::class);
        
    // });

    // Route::group(['middleware' => ['role_or_permission:SUPER|ADMIN|GESTOR|Reports_Index']], function () {
    //     //Route::resource('/importar', ImportarExcelController::class)->only(['index', 'store']);
    //     Route::get('/consolidado', ConsolidadoController::class);

    //     //reportes EXCEL
    //     Route::get('/reportConso/excel/', [ExportController::class, 'reportConsoEspe']);
    //     Route::get('/reportDeta/excel/', [ExportController::class, 'reportEspeDeta']);
    //     Route::get('/reportCitas/excel/{f1}/{f2}', [ExportController::class, 'reportCitas']);
    //     Route::get('/reportDetaCi/excel/{f1}/{f2}', [ExportController::class, 'reportCitaDet']);        
        
    // });

    Route::group(['middleware' => ['role_or_permission:ADMIN|Config_Index|User_Index|Role_Index|Permission_Index|Asignar_Index']], function () {
      
        Route::get('/home', UsersController::class);
        Route::get('/users', UsersController::class);
        Route::get('/roles', RolesController::class);
        Route::get('/permisos', PermisosController::class);
        Route::get('/asignar', AsignarController::class);  

    });

    Route::group(['middleware' => ['role_or_permission:ADMIN|Gest_Index|Product_Index|Category_Index']], function () {

        Route::get('/products', ProductsController::class);
        // Route::get('/permisos', PermisosController::class);
        // Route::get('/asignar', AsignarController::class);  

    });

    Route::group(['middleware' => ['role_or_permission:ADMIN|FACTURADOR|Reports_Index']], function () {

        //reportes EXCEL
        Route::get('/reportProduct/excel/', [ExportController::class, 'reportProducts']);
        Route::get('/reportProduct/excel/{f1}', [ExportController::class, 'reportProducts']);
        Route::get('/reportProduct/excel/{f1}/{f2}', [ExportController::class, 'reportProducts']);

        //reportes PDF
        Route::get('reportProduct/pdf/', [ExportController::class, 'reportPdfProduc']);
        Route::get('reportProduct/pdf/{f1}', [ExportController::class, 'reportPdfProduc']);
        Route::get('reportProduct/pdf/{f1}/{f2}', [ExportController::class, 'reportPdfProduc']);
        
        
        // Route::get('/reportDeta/excel/', [ExportController::class, 'reportEspeDeta']);
        // Route::get('/reportCitas/excel/{f1}/{f2}', [ExportController::class, 'reportCitas']);
        // Route::get('/reportDetaCi/excel/{f1}/{f2}', [ExportController::class, 'reportCitaDet']);        
        
    });

    Route::get('/profile', ProfileController::class);
    Route::get('/password', PasswordController::class);
        
});


