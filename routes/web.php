<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\GpuController;
use App\Http\Controllers\RequirementController;

use App\Http\Controllers\DataBase\AuthController;
use App\Http\Controllers\DataBase\TableController;
use App\Http\Controllers\DataBase\ItemController;
use App\Http\Controllers\DataBase\ContentController;
use App\Http\Controllers\DataBase\BackupController;
use App\Http\Controllers\DataBase\ConnectorController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'registerForm'])->name('auth.register');
    Route::post('/register',  [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::resource('/users', UserController::class)->only(['show']);
});

// Route::get('/backups/restore/{fileName}', [BackupController::class, 'restoreBackup'])->name('backup.restore');
// Route::resource('/backups', BackupController::class);

Route::middleware(['admin'])->group(function () {
    Route::get('/backups/restore/{fileName}', [BackupController::class, 'restoreBackup'])->name('backup.restore');
    Route::get('/backups/download/{fileName}', [BackupController::class, 'downloadBackup'])->name('backups.download');
    Route::resource('/backups', BackupController::class);
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin',  [AdminController::class, 'dashboard'])->name('admin');
    Route::resource('/users', UserController::class)->except(['show']);
    Route::resource('/content', ContentController::class);
    
    Route::resource('games', GameController::class);
    Route::resource('requirements', RequirementController::class);
    Route::resource('gpus', GpuController::class);


    Route::resource('/tables', TableController::class);
    Route::prefix('/tables')->group(function () {
        Route::get('/{table}/clean', [TableController::class, 'clean'])->name('table.clean');
        Route::get('/{table}/export', [TableController::class, 'export'])->name('table.export');
        Route::get('/{table}/import', [TableController::class, 'import'])->name('table.import');


        Route::prefix('/{table}')->group(function () {
            Route::get('/', [ItemController::class, 'index'])->name('items.index');
            Route::get('/create', [ItemController::class, 'create'])->name('items.create');
            Route::post('/', [ItemController::class, 'store'])->name('items.store');
            Route::get('/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
            Route::put('/{id}', [ItemController::class, 'update'])->name('items.update');
            Route::delete('/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
            Route::get('/{id}', [ItemController::class, 'show'])->name('items.show');
        });
    });
});

// Страницы без контроллеров
Route::view('/', 'main')->name('main');
Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contacts');
Route::view('/work', 'work')->name('work');
Route::view('/menu', 'sitemap')->name('sitemap');
Route::view('/assembly', 'assembly')->name('assembly');
Route::view('/servers', 'servers')->name('servers');

// Редиеркты
Route::redirect('/chat', 'https://crm.dnlmarket.ru/online/tecrent', 301)->name('chat');

// Ресурсные страницы
Route::resource('basket', BasketController::class);
Route::resource('computers', ComputerController::class);
Route::resource('games', GameController::class)->only(['show', 'index']);

// Почтовые сообщения
// Route::post('/mail/sendCart', 'CartController@sendCart')->name('cart.send');
// Route::post('/mail/feedback', 'MailController@feedback')->name('mail.feedback');

Route::post('/basket/send', [BasketController::class, 'send'])->name('basket.send');

Route::post('/connector/discord/{subject}', [ConnectorController::class, 'sendDiscord'])->name('send.discord');

Route::view('/any', 'main')->name('mail.feedback');
Route::get('/404', function () {
    abort(404);
});

Route::get('/sitemap', function () {
    $routes = collect(Route::getRoutes())->filter(function ($route) {
        return $route->getName() && $route->getDomain() == null;
    });

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($routes as $route) {
        if (strpos($route->uri(), '{') === false) {
            $xml .= '<url>';
            $xml .= '<loc>' . url($route->uri()) . '</loc>';
            $xml .= '<lastmod>' . date('c', filemtime(base_path('routes/web.php'))) . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }
    }

    $xml .= '</urlset>';

    $filePath ='sitemap.xml';

    File::put($filePath, $xml);
    
    return response($xml, 200, [
        'Content-Type' => 'application/xml'
    ]);
});
