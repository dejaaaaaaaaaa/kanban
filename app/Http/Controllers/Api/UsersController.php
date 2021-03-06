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
        return response()->json($this->userService->store($data));

    }

    public function show($id) :JsonResponse
    {
        $user = $this->userService->findById($id);
        if($user){
            return response()->json(UserResource::make($user));
        }
        return response()->json('User not found!');
    }

    public function update(UserUpdateRequest $request, $id) :JsonResponse
    {
        $data = $request->validated();
        $user = $this->userService->update($id, $data);
        if($user){
            return response()->json(UserResource::make($user));
        }
        return response()->json('User not updated!');
    }

    public function destroy($user)
    {
        $this->userService->delete($user);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
