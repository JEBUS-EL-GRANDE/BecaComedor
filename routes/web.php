<?php
/*use Illuminate\Support\Facades\Route;
// Controladores de Autenticación y Home
use App\Http\Controllers\AuthController;
// Controladores de Admin (Raíz y CRUDs)
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\CarreraController;
use App\Http\Controllers\Admin\EstudianteController;
use App\Http\Controllers\Admin\EncargadoController as AdminEncargadoController;
use App\Http\Controllers\Admin\TipoBecaController;
use App\Http\Controllers\Admin\PersonalCocinaController;
use App\Http\Controllers\Admin\ParticularController;
use App\Http\Controllers\Admin\AdministradorController;
// Controladores de Encargado (Login/Dashboard)
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\Encargado\ControlAsistenciaController;
use App\Http\Controllers\Encargado\TipoServicioController;
// Otros
use App\Http\Controllers\CocinaController;
use App\Http\Controllers\AsistenciaPublicaController;

// =========================================================================
// RUTAS DE AUTENTICACIÓN (LOGIN/LOGOUT GENERAL)
// =========================================================================
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [AuthController::class, 'welcome'])->middleware('auth')->name('home');

// =========================================================================
// RUTAS DE ADMINISTRADOR
// =========================================================================
// Login del Administrador
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Dashboard y Rutas CRUD del Administrador (Protegidas)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Rutas CRUD
    Route::resource('personas', PersonaController::class)->names('admin.personas');
    Route::resource('carreras', CarreraController::class)->names('admin.carreras');
    Route::resource('estudiantes', EstudianteController::class)->names('admin.estudiantes');
    Route::resource('encargados', AdminEncargadoController::class)->names('admin.encargados');
    Route::resource('tipobecas', TipoBecaController::class)->names('admin.tipobecas');
    Route::resource('personalcocina', PersonalCocinaController::class)->names('admin.personalcocina');
    Route::resource('particulares', ParticularController::class)->names('admin.particulares');
    Route::resource('administradores', AdministradorController::class)->names('admin.administradores');
});

// =========================================================================
// RUTAS DE ENCARGADO
// =========================================================================
// Login y Dashboard del Encargado
Route::get('/encargado/login', [EncargadoController::class, 'showLoginForm'])->name('encargado.login');
Route::post('/encargado/login', [EncargadoController::class, 'login'])->name('encargado.login.submit');

// Dashboard protegido para el Encargado
Route::get('/encargado/dashboard', [EncargadoController::class, 'dashboard'])
    ->middleware('auth:web', \App\Http\Middleware\CheckRole::class . ':ENCARGADO')
    ->name('encargado.dashboard');

// Grupo de rutas protegidas para el Encargado
Route::middleware(['auth:web', \App\Http\Middleware\CheckRole::class .':ENCARGADO'])->prefix('encargado/panel')->group(function () {
    // CRUD para CONTROL DE ASISTENCIA (Ahora bajo el prefijo 'encargado/panel')
    Route::resource('asistencia', ControlAsistenciaController::class)->names('encargado.asistencia');
    // CRUD para TIPO DE SERVICIO
    Route::resource('servicios', TipoServicioController::class)->names('encargado.servicios'); 
    Route::get('/test-servicios', function() {return 'Ruta de servicios funciona';})->name('test.servicios');
});

// =========================================================================
// RUTAS DE PERSONAL DE COCINA
// =========================================================================
Route::get('/cocina/login', [CocinaController::class, 'showLoginForm'])->name('cocina.horario.showLoginForm');
Route::post('/cocina/login', [CocinaController::class, 'login'])->name('cocina.horario.login');
Route::post('/cocina/logout', [CocinaController::class, 'logout'])->name('cocina.logout');

// Horario protegido (Solo una definición)
Route::get('/cocina/horario', [CocinaController::class, 'showHorario'])
    ->middleware('auth:web', 'rol:PERSONAL_COCINA')
    ->name('cocina.horario');
// =========================================================================
// RUTAS DE ASISTENCIA PÚBLICA
// =========================================================================

Route::get('/asistencia/registrar', [AsistenciaPublicaController::class, 'showLoginForm'])->name('asistencia.showLoginForm');
Route::post('/asistencia/registrar', [AsistenciaPublicaController::class, 'registrarAsistencia'])->name('asistencia.registrar');
Route::post('/asistencia/store', [AsistenciaPublicaController::class, 'storeAsistencia'])->name('asistencia.store');

// =========================================================================
// RUTAS DE ASISTENCIA PÚBLICA (DEBE IR PRIMERO PARA EVITAR CONFLICTOS)
// =========================================================================
Route::get('/asistencia-publica', [AsistenciaPublicaController::class, 'showLoginForm'])->name('asistencia.showLoginForm');
Route::post('/asistencia-publica', [AsistenciaPublicaController::class, 'registrarAsistencia'])->name('asistencia.registrar');
Route::post('/asistencia-publica-store', [AsistenciaPublicaController::class, 'storeAsistencia'])->name('asistencia.store');*/



use Illuminate\Support\Facades\Route;
// Controladores de Autenticación y Home
use App\Http\Controllers\AuthController;
// Controladores de Admin (Raíz y CRUDs)
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\CarreraController;
use App\Http\Controllers\Admin\EstudianteController;
use App\Http\Controllers\Admin\EncargadoController as AdminEncargadoController; // CRUD Encargado (Admin)
use App\Http\Controllers\Admin\TipoBecaController;
use App\Http\Controllers\Admin\PersonalCocinaController;
use App\Http\Controllers\Admin\ParticularController;
use App\Http\Controllers\Admin\AdministradorController;
// Controladores de Encargado (Login/Dashboard)
use App\Http\Controllers\EncargadoController; // Login Encargado
use App\Http\Controllers\Encargado\ControlAsistenciaController;
use App\Http\Controllers\Encargado\TipoServicioController;
// Otros
use App\Http\Controllers\CocinaController;
use App\Http\Controllers\AsistenciaPublicaController;
// =========================================================================
// RUTAS DE AUTENTICACIÓN (LOGIN/LOGOUT GENERAL)
// =========================================================================/*

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Ruta para procesar el registro
Route::post('/register', [AuthController::class, 'register']);
// Ruta para el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Ruta para procesar el login
Route::post('/login', [AuthController::class, 'login']);
// Ruta de logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Ruta protegida para el dashboard (la web de bienvenida)
Route::get('/', [AuthController::class, 'welcome'])->middleware('auth')->name('home');

// =========================================================================
// RUTAS DE ADMINISTRADOR
// =========================================================================
    // Rutas para el Administrador
    
        Route::resource('personalcocina', PersonalCocinaController::class)->names('admin.personalcocina');
        Route::resource('administradores', AdministradorController::class)->names('admin.administradores');
        Route::resource('tipobecas', TipoBecaController::class)->names('admin.tipobecas');
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login']);
    Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');
    // Dashboard de Administración (Protegida por el middleware 'admin')
    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::resource('personalcocina', PersonalCocinaController::class)->names('admin.personalcocina');
        Route::resource('administradores', AdministradorController::class)->names('admin.administradores');
        Route::resource('tipobecas', TipoBecaController::class)->names('admin.tipobecas');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('personas', PersonaController::class)->names('admin.personas');
    Route::get('/carreras', [AdminController::class, 'manageCarreras'])->name('admin.carreras');
    Route::get('/encargados', [AdminController::class, 'manageEncargados'])->name('admin.encargados');
    Route::get('/tipos-beca', [AdminController::class, 'manageTiposBeca'])->name('admin.tiposbeca');
    Route::get('/particulares', [AdminController::class, 'manageParticulares'])->name('admin.particulares');
    Route::get('/personal-cocina', [AdminController::class, 'managePersonalCocina'])->name('admin.personalcocina');
    Route::get('/estudiantes', [AdminController::class, 'manageEstudiantes'])->name('admin.estudiantes');
});
//**********************encargado********************************************** 
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rutas CRUD
    Route::resource('personas', PersonaController::class)->names('admin.personas');
    Route::resource('carreras', CarreraController::class)->names('admin.carreras');
    Route::resource('estudiantes', EstudianteController::class)->names('admin.estudiantes');
    Route::resource('encargados', AdminEncargadoController::class)->names('admin.encargados');
    Route::resource('tipobecas', TipoBecaController::class)->names('admin.tipobecas');
    Route::resource('personalcocina', PersonalCocinaController::class)->names('admin.personalcocina');
    
    // ✅ Esta es la ruta CORRECTA para particulares
    Route::resource('particulares', ParticularController::class)->names('admin.particulares');
    
    Route::resource('administradores', AdministradorController::class)->names('admin.administradores');
    
    // Elimina estas líneas que duplican funcionalidad:
    // Route::get('/particulares', [AdminController::class, 'manageParticulares'])->name('admin.particulares');
    // Route::get('/carreras', [AdminController::class, 'manageCarreras'])->name('admin.carreras');
    // etc...
});
// =========================================================================
// RUTAS DE ENCARGADO
// =========================================================================
// Login y Dashboard del Encargado
Route::resource('servicios', TipoServicioController::class)->names('encargado.servicios');
Route::resource('asistencia', ControlAsistenciaController::class)->names('encargado.asistencia');
Route::get('/encargado/login', [EncargadoController::class, 'showLoginForm'])->name('encargado.login');
Route::post('/encargado/login', [EncargadoController::class, 'login'])->name('encargado.login.submit');
// Dashboard protegido (donde falla el middleware)
Route::get('/encargado/dashboard', [EncargadoController::class, 'dashboard'])
    ->middleware('auth:web', \App\Http\Middleware\CheckRole::class . ':ENCARGADO')
    ->name('encargado.dashboard');
    Route::get('/test-servicios', function() {return 'Ruta de servicios funciona';})->name('test.servicios');
// Grupo de rutas protegidas para el Encargado
Route::middleware(['auth:web', \App\Http\Middleware\CheckRole::class .':ENCARGADO'])->prefix('encargado/panel')->group(function () {
    // CRUD para CONTROL DE ASISTENCIA
    Route::resource('asistencia', ControlAsistenciaController::class)->names('encargado.asistencia'); 
    // CRUD para TIPO DE SERVICIO
    Route::resource('servicios', TipoServicioController::class)->names('encargado.servicios'); 
    Route::get('/test-servicios', function() {return 'Ruta de servicios funciona';})->name('test.servicios');
    Route::resource('asistencia', ControlAsistenciaController::class)->names('encargado.servicios'); 
});

// =========================================================================
// RUTAS DE PERSONAL DE COCINA
// =========================================================================
Route::get('/cocina/login', [CocinaController::class, 'showLoginForm'])->name('cocina.horario.showLoginForm');
Route::post('/cocina/login', [CocinaController::class, 'login'])->name('cocina.horario.login');
Route::get('/cocina/horario', [CocinaController::class, 'showHorario'])
    ->middleware('auth:web', 'rol:PERSONAL_COCINA')
    ->name('cocina.horario');
Route::get('/cocina/horario', [CocinaController::class, 'showHorario'])->name('cocina.horario');
Route::post('/cocina/logout', [CocinaController::class, 'logout'])->name('cocina.logout');

// =========================================================================
// RUTAS DE ASISTENCIA PÚBLICA
// =========================================================================

Route::get('/asistencia/registrar', [AsistenciaPublicaController::class, 'showLoginForm'])->name('asistencia.showLoginForm');
Route::post('/asistencia/registrar', [AsistenciaPublicaController::class, 'registrarAsistencia'])->name('asistencia.registrar');
Route::post('/asistencia/store', [AsistenciaPublicaController::class, 'storeAsistencia'])->name('asistencia.store');

// =========================================================================
// RUTAS DE ASISTENCIA PÚBLICA (DEBE IR PRIMERO PARA EVITAR CONFLICTOS)
// =========================================================================
Route::get('/asistencia-publica', [AsistenciaPublicaController::class, 'showLoginForm'])->name('asistencia.showLoginForm');
Route::post('/asistencia-publica', [AsistenciaPublicaController::class, 'registrarAsistencia'])->name('asistencia.registrar');
Route::post('/asistencia-publica-store', [AsistenciaPublicaController::class, 'storeAsistencia'])->name('asistencia.store');

