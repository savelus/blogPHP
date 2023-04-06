<?php

use App\Http\Controllers\Admin\Post\PostIndexController;
use App\Http\Controllers\Admin\Post\PostShowController;
use App\Http\Controllers\Admin\Post\PostCreateController;
use App\Http\Controllers\Admin\Post\PostDeleteController;
use App\Http\Controllers\Admin\Post\PostEditController;
use App\Http\Controllers\Admin\Post\PostStoreController;
use App\Http\Controllers\Admin\Post\PostUpdateController;

use App\Http\Controllers\Admin\Tag\TagCreateController;
use App\Http\Controllers\Admin\Tag\TagDeleteController;
use App\Http\Controllers\Admin\Tag\TagEditController;
use App\Http\Controllers\Admin\Tag\TagIndexController;
use App\Http\Controllers\Admin\Tag\TagShowController;
use App\Http\Controllers\Admin\Tag\TagStoreController;
use App\Http\Controllers\Admin\Tag\TagUpdateController;

use App\Http\Controllers\Admin\User\UserCreateController;
use App\Http\Controllers\Admin\User\UserDeleteController;
use App\Http\Controllers\Admin\User\UserEditController;
use App\Http\Controllers\Admin\User\UserIndexController;
use App\Http\Controllers\Admin\User\UserShowController;
use App\Http\Controllers\Admin\User\UserStoreController;
use App\Http\Controllers\Admin\User\UserUpdateController;


use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\Post\CategoryPostController;
use App\Http\Controllers\Personal\Comment\CommentDeleteController;
use App\Http\Controllers\Personal\Comment\CommentEditController;
use App\Http\Controllers\Personal\Comment\CommentIndexController;
use App\Http\Controllers\Personal\Comment\CommentUpdateController;

use App\Http\Controllers\Personal\Liked\LikedDeleteController;
use App\Http\Controllers\Personal\Liked\likedIndexController;

use App\Http\Controllers\Personal\Main\PersonalIndexController;

use App\Http\Controllers\Post\Comment\StoreController;
use App\Http\Controllers\Post\Like\LikeStoreController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\IndexController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Main\AdminIndexController;

use App\Http\Controllers\Admin\Category\CategoryIndexController;
use App\Http\Controllers\Admin\Category\CategoryCreateController;
use App\Http\Controllers\Admin\Category\CategoryStoreController;
use App\Http\Controllers\Admin\Category\CategoryShowController;
use App\Http\Controllers\Admin\Category\CategoryEditController;
use App\Http\Controllers\Admin\Category\CategoryUpdateController;
use App\Http\Controllers\Admin\Category\CategoryDeleteController;

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

Route::get('/', [HomeController::class, '__invoke'])->name('main.index');

Route::prefix('posts')->namespace('Post')->group(function (){
    Route::get('/', [IndexController::class, '__invoke'])->name('post.index');
    Route::get('/{post}', [ShowController::class, '__invoke'])->name('post.show');
    Route::prefix('{post}/comments')->namespace('Comment')->group(function (){
        Route::post('/', [StoreController::class, '__invoke'])->name('post.comment.store');
    });
    Route::prefix('{post}/likes')->namespace('Like')->group(function (){
        Route::post('/', [LikeStoreController::class, '__invoke'])->name('post.like.store');
    });

});

Route::prefix('categories')->namespace('Category')->group(function (){
    Route::get('/', [CategoryController::class, '__invoke'])->name('category.index');
    Route::prefix('{category}/posts')->namespace('Like')->group(function (){
        Route::get('/', [CategoryPostController::class, '__invoke'])->name('category.post.index');
    });

});



Route::prefix('personal')->middleware(['auth', 'verified'])->group(function () {
    Route::group(['namespace'=>'Main'], function (){
        Route::get('/', [PersonalIndexController::class, '__invoke'])->name('personal.main.index');
    });
    Route::group(['namespace'=>'Liked'], function (){
        Route::get('/liked', [LikedIndexController::class, '__invoke'])->name('personal.liked.index');
        Route::delete('/liked/{post}', [LikedDeleteController::class, '__invoke'])->name('personal.liked.delete');
    });
    Route::group(['namespace'=>'Comment'], function (){
        Route::get('/comment', [CommentIndexController::class, '__invoke'])->name('personal.comment.index');
        Route::get('/comment/{comment}/edit', [CommentEditController::class, '__invoke'])->name('personal.comment.edit');
        Route::patch('/comment/{comment}', [CommentUpdateController::class, '__invoke'])->name('personal.comment.update');
        Route::delete('/comment/{comment}', [CommentDeleteController::class, '__invoke'])->name('personal.comment.delete');
    });
});
Route::prefix('admin')->middleware(['auth','admin', 'verified'])->group(function () {
    Route::group(['namespace'=>'Main'], function (){
        Route::get('/', [AdminIndexController::class, '__invoke'])->name('admin.main.index');
    });

    Route::prefix('categories')->group(function (){
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CategoryCreateController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [CategoryStoreController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [CategoryShowController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [CategoryEditController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [CategoryUpdateController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryDeleteController::class, '__invoke'])->name('admin.category.delete');
    });
    Route::prefix('tags')->group(function (){
        Route::get('/', [TagIndexController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [TagCreateController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [TagStoreController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [TagShowController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagEditController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagUpdateController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagDeleteController::class, '__invoke'])->name('admin.tag.delete');
    });
    Route::prefix('posts')->group(function (){
        Route::get('/', [PostIndexController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [PostCreateController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [PostStoreController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [PostShowController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostEditController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [PostUpdateController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [PostDeleteController::class, '__invoke'])->name('admin.post.delete');
    });
    Route::prefix('users')->group(function (){
        Route::get('/', [UserIndexController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [UserCreateController::class, '__invoke'])->name('admin.user.create');
        Route::post('/', [UserStoreController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}', [UserShowController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserEditController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}', [UserUpdateController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}', [UserDeleteController::class, '__invoke'])->name('admin.user.delete');
    });
});

Auth::routes(['verify' => true]);
