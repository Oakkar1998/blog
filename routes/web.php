<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CreatorStudioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;


Route::get('/', [HomeController::class, 'home'])->name('home');



Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

 
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);




Route::middleware('auth')->group(function () {
    

    //Profile
    Route::get('profilePage',[ProfileController::class,'profilePage'])->name('profile.Page');

    //About 
    Route::get('aboutPage',[ProfileController::class,'aboutPage'])->name('profile.aboutPage');

    //Creator Studio
    Route::prefix('blogger')->middleware(['auth', 'blogger'])->group(function () {
        Route::get('creatorStudioPage',[CreatorStudioController::class,'creatorStudioPage'])->name('profile.creatorStudioPage');
        Route::get('articlePage',[CreatorStudioController::class,'articlePage'])->name('creator.articlePage');
        Route::get('createArticlePage',[CreatorStudioController::class,'createArticlePage'])->name('creator.createArticlePage');
        Route::get('editArticlePage/{id}',[CreatorStudioController::class,'editArticlePage'])->name('creator.editArticlePage');
        Route::post('editArticle/{id}',[CreatorStudioController::class,'editArticle'])->name('creator.editArticle');
        Route::get('viewArticlePage/{id}',[CreatorStudioController::class,'viewArticlePage'])->name('creator.viewArticlePage');
        Route::post('uploadCreatorImage',[CreatorStudioController::class,'uploadCreatorImage'])->name('creator.uploadCreatorImage');
        Route::get('categoryPage',[CreatorStudioController::class,'categoryPage'])->name('creator.categoryPage');
        Route::post('createArticle',[CreatorStudioController::class,'create'])->name('article.create');
        Route::post('createCategory',[CreatorStudioController::class,'createCategory'])->name('creator.createCategory');
        Route::post('/editCategory/{cateId}', [CreatorStudioController::class, 'editCategory'])->name('creator.editCategory');
        Route::get('allusersPage',[CreatorStudioController::class,'allusersPage'])->name('profile.allusersPage');
        Route::delete('deleteUser/{id}',[CreatorStudioController::class,'deleteUser'])->name('profile.deleteUser');
        Route::delete('deleteCategory/{categoryId}',[CreatorStudioController::class,'deleteCategory'])->name('creator.deleteCategory');
        Route::get('notePage',[CreatorStudioController::class,'notePage'])->name('profile.notePage');
        Route::post('createNote',[CreatorStudioController::class,'createNote'])->name('creator.createNote');
    });
    
    //Article management
    Route::get('readArticlePage/{articleId}',[ArticleController::class,'readArticlePage'])->name('article.readArticlePage');
    Route::get('loveArticle/{articleId}',[ArticleController::class,'loveArticle'])->name('article.loveArticle');
    Route::get('saveArticle/{articleId}',[ArticleController::class,'saveArticle'])->name('article.saveArticle');
    Route::delete('deleteArticle/{articleId}',[ArticleController::class,'deleteArticle'])->name('article.deleteArticle');
    Route::post('commentArticle/{articleId}',[ArticleController::class,'commentArticle'])->name('article.commentArticle');
    Route::delete('deleteComment/{id}', [ArticleController::class, 'deleteComment'])->name('article.deleteComment');
    Route::post('editComment/{id}', [ArticleController::class, 'editComment'])->name('article.editComment');

    Route::get('/notifications/read/{id}', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        // Return the notifications page with updated data
        return back(); // Or redirect to a specific page
    })->name('notifications.read');

    

    // Mark all unread notifications as read
    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['status' => 'read']);
    })->name('notifications.markAllRead');

    // Mark all as unread (set `read_at` to null)
    Route::post('/notifications/mark-all-unread', function () {
        auth()->user()->notifications()->update(['read_at' => null]);
        return response()->json(['status' => 'unread']);
    })->name('notifications.markAllUnread');

    Route::get('/download-article-pdf/{id}', [ArticleController::class, 'downloadPDF'])->name('article.pdf');

});

require __DIR__.'/auth.php';
