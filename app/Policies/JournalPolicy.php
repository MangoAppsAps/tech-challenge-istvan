<?php

namespace App\Policies;

use App\Journal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JournalPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Journal  $journal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Journal $journal)
    {
        return $user->id === $journal->client->user_id;
    }
}
