<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Posts;
use Illuminate\Validation\Rule;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// GET /api/posts
Route::get('/posts', function () {
    $posts = Posts::paginate(2);
    return response()->json($posts);
});

// GET /api/posts/{id}
Route::get('/posts/{id}', function ($id) {
    $post = Posts::find($id);
    if ($post) {
        return response()->json($post);
    } else {
        return response()->json(['error' => 'Post not found'], 404);
    }
});

// POST /api/posts
Route::post('/posts', function (Request $request) {
    $validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'content' => 'required',
    ]);

    $post = Posts::create($validatedData);

    return response()->json($post, 201);
});

// PUT /api/posts/{id}
Route::put('/posts/{id}', function (Request $request, $id) {
    $post = Posts::find($id);

    if ($post) {
        $validatedData = $request->validate([
            'title' => ['required', Rule::unique('posts')->ignore($post->id), 'max:255'],
            'content' => 'required',
        ]);

        $post->update($validatedData);

        return response()->json($post);
    } else {
        return response()->json(['error' => 'Post not found'], 404);
    }
});

// DELETE /api/posts/{id}
Route::delete('/posts/{id}', function ($id) {
    $post = Posts::find($id);

    if ($post) {
        $post->delete();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['error' => 'Post not found'], 404);
    }
});
