<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Equipment;

class EquipmentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function destroy(User $user, Equipment $equipement)
    {
        return $user->id == $equipement->user_id;
    }
}
