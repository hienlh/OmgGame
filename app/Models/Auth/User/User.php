<?php

namespace OmgGame\Models\Auth\User;

use Carbon\Carbon;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use OmgGame\Models\Auth\Role\Role;
use OmgGame\Models\Auth\User\Traits\Ables\Protectable;
use OmgGame\Models\Auth\User\Traits\Attributes\UserAttributes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OmgGame\Models\Auth\User\Traits\Ables\Rolable;
use OmgGame\Models\Auth\User\Traits\Scopes\UserScopes;
use OmgGame\Models\Auth\User\Traits\Relations\UserRelations;
use Kyslik\ColumnSortable\Sortable;
use OmgGame\Models\Protection\ProtectionShopToken;
use OmgGame\Models\Protection\ProtectionValidation;

/**
 * OmgGame\Models\Auth\User\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property string $confirmation_code
 * @property bool $confirmed
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read mixed $avatar
 * @property-read mixed $licensee_name
 * @property-read mixed $licensee_number
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Collection|ProtectionShopToken[] $protectionShopTokens
 * @property-read ProtectionValidation $protectionValidation
 * @property-read Collection|SocialAccount[] $providers
 * @property-read Collection|Role[] $roles
 * @method static Builder|User sortable($defaultSortParameters = null)
 * @method static Builder|User whereActive($value)
 * @method static Builder|User whereConfirmationCode($value)
 * @method static Builder|User whereConfirmed($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($role)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use Rolable,
        UserAttributes,
        UserScopes,
        UserRelations,
        Notifiable,
        SoftDeletes,
        Sortable,
        Protectable;

    public $sortable = ['name', 'email', 'created_at', 'updated_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'active', 'confirmation_code', 'confirmed'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function games()
    {
        return $this->hasMany('OmgGame\Models\Game', 'game_id', 'id');
    }
}
