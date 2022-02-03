<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


    Route::middleware('auth' , 'priventbackhistory')->group(function(){

        Route::get('/users'                     , [UserController::class , 'index'])->name('user.all');
        Route::prefix('user')->name('user.')->group(function(){
            Route::get('/profile'               , [UserController::class , 'profile'])->name('profile');
            Route::put('/profile/update'        , [UserController::class , 'update'])->name('update');
        });
        Route::prefix('question')->name('question.')->group(function(){
            Route::get('/create/question'       , [QuestionController::class, 'create'])->name('create');
            Route::post('/store/question'       , [QuestionController::class, 'store'])->name('store');
            Route::get('/{id}/edit'             , [QuestionController::class, 'edit'])->name('edit');
            Route::put('/{id}/update'           , [QuestionController::class, 'update'])->name('update');
            Route::post('/{id}/delete'          , [QuestionController::class, 'delete'])->name('delete');
        });
        Route::prefix('question')-> name('question.')->group(function(){
            Route::post('/user/answer'          , [AnswerController::class , 'store'])->name('store.answer');
            Route::put('/best/answer/{id}'      , [AnswerController::class , 'bestAnswer'])->name('best.answer');
        });

    });

    Auth::routes();
        // Route::get('/home'                      , [HomeController::class , 'index'])->name('home');

        Route::get('/questions'                 , [QuestionController::class, 'index'])->name('questions.all');
        Route::get('/show/{id}/question'        , [QuestionController::class, 'show'])->name('show.question');


