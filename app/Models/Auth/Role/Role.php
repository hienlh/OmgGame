<?php

namespace OmgGame\Models\Auth\Role;

use OmgGame\Models\Auth\User\User;
use Carbon\Carbon;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use OmgGame\Models\Auth\Role\Traits\Scopes\RoleScopes;
use OmgGame\Models\Auth\Role\Traits\Relations\RoleRelations;
use Illuminate\Database\Query\Builder;

/**
 * OmgGame\Models\Auth\Role\Role
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|User[] $users
 * @method static Builder|Role sort($direction = 'asc')
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @method static Builder|Role whereWeight($value)
 * @mixin Eloquent
 */
class Role extends Model
{
    use RoleScopes,
        RoleRelations;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
