<?php

namespace OmgGame\Models\Auth\Role\Traits\Relations;

use OmgGame\Models\Auth\User\User;

trait RoleRelations
{
    /**
     * Relation with users
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    }
}
