<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Responses\UserPostResource;
use App\Models\Post;

class UserPostController extends Controller
{

    public function index()
    {
    }

    public function show()
    {
    }

    public function store(CreatePostRequest $request): UserPostResource
    {
        $post = new Post($request->validated());
        $request->user()->posts()->save($post);

        return new UserPostResource($post);
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
