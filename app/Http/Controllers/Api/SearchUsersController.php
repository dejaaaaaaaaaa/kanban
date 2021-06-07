<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\SearchUserService;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchUsersController extends Controller
{
    protected $searchUserService;

    public function __construct(SearchUserService $searchUserService)
    {
        $this->searchUserService = $searchUserService;
    }

    public function search(Request $request) :JsonResponse
    {
        return response()->json(UserResource::collection($this->searchUserService->search($request->phrase)));
    }
}
