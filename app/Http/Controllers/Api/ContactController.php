// app/Http/Controllers/Api/ContactController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Services\PortfolioContentManager;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->contentManager->getAllContacts(),
        ]);
    }

    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = $this->contentManager->createContact($request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => ['id' => $contact->id],
        ], 201);
    }

    public function update(StoreContactRequest $request, Contact $contact): JsonResponse
    {
        $updated = $this->contentManager->updateContact($contact, $request->validated());
        return response()->json([
            'status' => 'success',
            'data'   => $updated,
        ]);
    }

    public function destroy(Contact $contact): JsonResponse
    {
        $this->contentManager->deleteContact($contact);
        return response()->json(['status' => 'success']);
    }
}