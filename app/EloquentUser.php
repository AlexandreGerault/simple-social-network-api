<?php

namespace App;

use App\Models\EloquentPost;
use Domain\SSN\Auth\Entity\User;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class EloquentUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createFromUser(User $user)
    {
        (new self())
            ->setAttribute('id', $user->getId()->toString())
            ->setAttribute('username', $user->getUsername())
            ->setAttribute('email', $user->getEmail())
            ->setAttribute('password', $user->getPassword())
        ->save();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(EloquentPost::class, 'user_id', 'id');
    }
}
