// app/Http/Controllers/Api/TechStackController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TechStackManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    public function __construct(
        private readonly TechStackManager $techStackManager
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->techStackManager->getAllStacks(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'stacks'   => ['required', 'array', 'min:1'],
            'stacks.*' => ['integer', 'exists:tech_stack_selection,id'],
        ]);

        $this->techStackManager->updateSelection($request->input('stacks'));

        return response()->json(['status' => 'success']);
    }
}