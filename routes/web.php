<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowAPIController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TicketMasterController;
use App\Http\Controllers\RepresentationController;
use Spatie\Feed\Feed;
 use Spatie\Feed\FeedItem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Rout for read the logs
 */
Route::get('/logs', function () {
    $logPath = storage_path('logs/laravel.log');

    if (File::exists($logPath)) {
        $logContent = File::get($logPath);
        return response($logContent, 200)->header('Content-Type', 'text/plain');
    } else {
        abort(404, 'Log file not found');
    }
});
/**
 * FluxRSS
 */
 /*Route::get('/rss', function () {
     $feed = Feed::create()
         ->title('Mon Flux RSS')
         ->description('Ceci est un exemple de flux RSS')
         ->link('http://exemple.com');

     // Ajoutez des articles au flux RSS
     $articles = App\Article::all();

     foreach ($articles as $article) {
         $feed->add(FeedItem::create()
             ->title($article->title)
             ->summary($article->summary)
             ->link($article->url)
             ->author($article->author)
             ->updated($article->updated_at)
         );
     }

     return $feed->toResponse();
 });*/

Route::get('/artist', [ArtistController::class, 'index'])
    ->name('artist.index');
Route::get('/artist/{id}', [ArtistController::class, 'show'])
	->where('id', '[0-9]+')->name('artist.show');
Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])
	->where('id', '[0-9]+')->name('artist.edit');
Route::put('/artist/{id}', [ArtistController::class, 'update'])
	->where('id', '[0-9]+')->name('artist.update');
Route::get('/artist/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');
Route::delete('/artist/{id}', [ArtistController::class, 'destroy'])
	->where('id', '[0-9]+')->name('artist.delete');

Route::get('/type', [TypeController::class, 'index'])
    ->name('type.index');
Route::get('/type/{id}', [TypeController::class, 'show'])
    ->where('id', '[0-9]+')->name('type.show');

Route::get('/locality', [LocalityController::class, 'index'])
    ->name('locality.index');
Route::get('/locality/{id}',[LocalityController::class,'show'])
    ->where('id','[0-9]+')->name('locality.show');

Route::get('location', [LocationController::class, 'index'])->name('location.index');
Route::get('location/{id}', [LocationController::class, 'show'])
->where('id', '[0-9]+')->name('location.show');

Route::get('/show', [ShowController::class, 'index'])->name('show.index');
Route::get('/show/{id}', [ShowController::class, 'show'])
->where('id', '[0-9]+')->name('show.show');

/*API TicketMaster*/
//Route::get('/apii', [ShowAPIController::class, 'index'])->name('apii.index');
Route::get('/theatres', [TicketmasterController::class, 'getTheatreData'])->name('theatres');

/*System de payement Laravel Stripe*/
Route::post('/process/payment', [PaymentController::class, 'processPayment'])->name('process.payment');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');

Route::get('/', [ShowController::class, 'index'])->name('acceuil');

Route::get('/representation', [RepresentationController::class, 'index'])
->name('representation.index');
Route::get('/representation/{id}', [RepresentationController::class, 'show'])
->where('id', '[0-9]+')->name('representation.show');

Route::get('/role',[RoleController::class,'index'])
    ->name('role.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/*Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Protection des routes Voyager par le middleware "auth"
    Route::middleware(['auth'])->group(function () {
        // Vos routes protégées par "auth" ici
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
