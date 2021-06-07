<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request) :JsonResponse
    {
        return response()->json(UserResource::collection($this->userService->index()));
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->validated();
        return response()->json(['data' => $this->userService->store($data)]);

    }

    public function show($id)
    {
        return response()->json(UserResource::make($this->userService->findById($id)));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();
        return response()->json(UserResource::make($this->userService->update($id, $data)));
    }

    public function destroy($user)
    {
        $this->userService->delete($user);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
