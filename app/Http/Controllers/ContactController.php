<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Notifications\ContactReceiptNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        $contactMessage = ContactMessage::create($validated);

        Mail::to(config('contact.admin_email'))
            ->queue(new ContactMessageReceived($contactMessage));

        Notification::route('mail', $contactMessage->email)
            ->notify(new ContactReceiptNotification($contactMessage));

        return redirect()
            ->route('contact.create')
            ->with('success', 'Thanks! Your message has been received.');
    }
}