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
            'name' => [
                'bail',
                'required',
                'string',
                'min:2',
                'max:100',
            ],
            'email' => [
                'bail',
                'required',
                'string',
                'max:255',
                'email:rfc',
            ],
            'subject' => [
                'bail',
                'required',
                'string',
                'min:3',
                'max:150',
            ],
            'message' => [
                'bail',
                'required',
                'string',
                'min:10',
                'max:5000',
            ],
        ], [
            'name.required' => 'Please enter your name.',
            'name.min' => 'Your name must contain at least 2 characters.',
            'name.max' => 'Your name must not exceed 100 characters.',

            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Your email must not exceed 255 characters.',

            'subject.required' => 'Please enter a subject.',
            'subject.min' => 'The subject must contain at least 3 characters.',
            'subject.max' => 'The subject must not exceed 150 characters.',

            'message.required' => 'Please enter your message.',
            'message.min' => 'Your message must contain at least 10 characters.',
            'message.max' => 'Your message must not exceed 5000 characters.',

            'string' => 'The :attribute must be text.',
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