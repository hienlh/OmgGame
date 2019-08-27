<?php

namespace OmgGame\Models\Auth\User\Traits\Relations;

use OmgGame\Models\Auth\Permission\Permission;
use OmgGame\Models\Auth\Role\Role;
use OmgGame\Models\Auth\User\SocialAccount;
use OmgGame\Models\Auth\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SocialAccountRelations
{
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
