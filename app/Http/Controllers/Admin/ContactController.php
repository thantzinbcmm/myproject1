// app/Http/Controllers/Admin/ContactController.php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Services\PortfolioContentManager;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        private readonly PortfolioContentManager $contentManager
    ) {}

    public function store(StoreContactRequest $request): RedirectResponse
    {
        $this->contentManager->createContact($request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'contact'])
            ->with('success', '連絡先を登録しました。');
    }

    public function update(StoreContactRequest $request, Contact $contact): RedirectResponse
    {
        $this->contentManager->updateContact($contact, $request->validated());
        return redirect()
            ->route('admin.contents.index', ['tab' => 'contact'])
            ->with('success', '連絡先を更新しました。');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $this->contentManager->deleteContact($contact);
        return redirect()
            ->route('admin.contents.index', ['tab' => 'contact'])
            ->with('success', '連絡先を削除しました。');
    }
}