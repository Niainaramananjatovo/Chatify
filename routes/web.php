<?php

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Discussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Message;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('soket',[PostController::class,'index']);
Route::get('/', function () {
    return view('connexion');
});

Route::get('inscription', function () {
    if (Auth::user()) {
        return redirect('acceuil');
    }
    return view('inscription');
});

Route::get('/welcome', function () {
    return view('welcome');
});


Route::post('CreateUser', [UserController::class, 'createUser']);
Route::post('authentification', [UserController::class, 'authentification']);

Route::group(['middleware' => 'auth.user'], function () {
    Route::get('acceuil', function () {
        return view('acceuil');
    });
    Route::get('deconnexion', function () {
        Auth::logout();
        return redirect('/');
    });
    Route::get('/resultSearch/{data}', function ($data) {
        return view('layouts.resultSearch', ['data' => $data]);
    });

    Route::get('/discussion', function () {
        return view('layouts.discussion');
    });
    // 
    Route::get('setting', function () {
        return view('layouts.setting');
    });

    Route::get('profile', function () {
        return view('layouts.profil');
    });

    Route::get('/message/{user_name}/{id_discution}', function ($user_name, $id_discution) {
        return view('layouts.message', ['user_name' => $user_name, 'id_discution' => $id_discution]);
    });
    //
    Route::get('/addUserDiscussion/{id_to}', [Discussion::class, 'addConversation']);

    Route::get('/getDiscussion', [Discussion::class, 'getDiscussion']);

    Route::get('/getSearchPerson/{data}', [UserController::class, 'searchPerson']);

    Route::get('profile', function () {
        return view('layouts.profil');
    });


    Route::post('addmessage', [Message::class, 'addMessage']);
    Route::get('getmesssage', [Message::class, 'getMessage']);

    Route::get('lastmessage/{id}', [Message::class, 'getLastMessage']);

    Route::get('unseen', [Message::class, 'getUnseenMessage']);
});

Route::get('/admin', function () {
    if (!Gate::allows('user_admin')) {
        abort('403');
    } else {
        return view('admin');
    }
});
