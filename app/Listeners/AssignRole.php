<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Larapacks\Authorization\Role;
use LdapRecord\Laravel\Events\Authenticated;
use LdapRecord\Models\ActiveDirectory\Group;

class AssignRole
{
    /**
     * Handle the authenticated event.
     *
     * @param Authenticated $event
     *
     * @return void
     */
    public function handle(Authenticated $event)
    {
        if (! $group = Group::findByAnr('Web Administrator')) {
            return;
        }

        if (! $role = Role::where('name', '=', 'administrator')->first()) {
            return;
        }

        // We will make sure the users database model is saved
        // before we start performing role operations.
        $event->model->save();

        if (! $event->user->groups()->recursive()->exists($group)) {
            // The user is not a member of our LDAP administrator
            // group. We will detach roles incase they have been
            // removed from the LDAP group.

            $event->model->roles()->detach();

            return;
        }

        // The user is a member of LDAP administrator group. Add the role to their account.
        $event->model->roles()->sync($role);
    }
}
