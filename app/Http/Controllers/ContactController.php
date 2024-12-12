<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Fetch and display contacts
    public function index()
    {
        $contacts = Contact::all(); // Fetch all contacts
        return view('contacts.index', compact('contacts'));
    }

    // Store a new contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact added successfully!');
    }

    // Update an existing contact
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    // Delete a contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
