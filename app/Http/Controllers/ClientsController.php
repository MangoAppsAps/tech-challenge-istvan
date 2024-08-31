<?php

namespace App\Http\Controllers;

use App\Client;
use App\Rules;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $clients = $request->user()->clients;

        foreach ($clients as $client) {
            $client->append('bookings_count');
        }

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);

        $client->load('bookings', 'journals');

        return view('clients.show', ['client' => $client]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:190'],
            // We use the `filter` variant of the email rule, because the default implementation
            // does not check for dot in the domain part.
            'email' => ['required', 'email:filter'],
            'phone' => new Rules\PhoneNumber(),
            'address' => 'nullable',
            'city' => 'nullable',
            'postcode' => 'nullable',
        ]);

        $client = new Client;
        $client->name = $validated['name'];
        $client->email = $validated['email'];
        $client->phone = $validated['phone'];
        $client->address = $validated['address'];
        $client->city = $validated['city'];
        $client->postcode = $validated['postcode'];
        $client->save();

        return $client;
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        
        $client->delete();

        return 'Deleted';
    }
}
