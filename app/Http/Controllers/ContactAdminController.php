<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()
            ->paginate(10);

        return view('posts.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $contact->update([
            'is_read' => true,
        ]);

        return view('posts.contacts.show', compact('contact'));
    }
}
