<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Create a new user
     *
     * @param StoreUserRequest $request
     * @return Response
     */
    public function store(StoreUserRequest $request): Response
    {
        User::create($request->all());
        return response()->noContent(201);
    }
}
