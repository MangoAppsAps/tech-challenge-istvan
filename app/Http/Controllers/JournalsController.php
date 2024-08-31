<?php

namespace App\Http\Controllers;

use App\Client;
use App\Journal;
use Illuminate\Http\Request;

class JournalsController extends Controller
{
    public function create(Client $client)
    {
        $this->authorize('createJournal', $client);

        return view('journals.create', [
            'client' => $client,
        ]);
    }

    public function store(Request $request, Client $client)
    {
        $this->authorize('createJournal', $client);
        
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        $journal = new Journal();
        $journal->date = $validated['date'];
        $journal->description = $validated['description'];
        $journal->client_id = $client->id;
        $journal->save();

        $journal->load('client');

        return $journal;
    }

    public function destroy(Journal $journal)
    {
        $this->authorize('delete', $journal);
        
        $journal->delete();

        return 'Deleted';
    }
}
