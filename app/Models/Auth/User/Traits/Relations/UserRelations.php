<?php

namespace OmgGame\Models\Auth\User\Traits\Relations;

use OmgGame\Models\Auth\Role\Role;
use OmgGame\Models\Auth\User\SocialAccount;
use OmgGame\Models\Protection\ProtectionShopToken;
use OmgGame\Models\Protection\ProtectionValidation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelations
{
    /**
     * Relation with role
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
    }

    /**
     * Relation with social provider
     *
     * @return HasMany
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * Relation with protection validation
     *
     * @return mixed
     */
    public function protectionValidation()
    {
        return $this->hasOne(ProtectionValidation::class);
    }

    /**
     * Relation with protection shop tokens
     *
     * @return mixed
     */
    public function protectionShopTokens()
    {
        return $this->hasMany(ProtectionShopToken::class);
    }
}
