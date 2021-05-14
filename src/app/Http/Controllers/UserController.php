<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * Display the specified user.
     *
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function show(Request $request, string $id): Response
    {
        $user = User::findOrFail($id);

        return (new UserResource($user))->response();
    }
}
