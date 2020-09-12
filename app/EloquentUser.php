<?php

namespace App;

use App\Models\EloquentPost;
use Domain\SSN\Auth\Entity\User;
use Domain\SSN\Posts\Entity\Post;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

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

    public static function fromUser(User $user, self $eloquent = null)
    {
        return ($eloquent ?? new self())
            ->setAttribute('id', $user->getId()->toString())
            ->setAttribute('username', $user->getUsername())
            ->setAttribute('email', $user->getEmail())
            ->setAttribute('password', $user->getPassword());
    }

    public static function toUser(self $eloquentUser): User
    {
        ($user = new User(
            Uuid::fromString($eloquentUser->id),
            $eloquentUser->username,
            $eloquentUser->email,
            $eloquentUser->password,
        ))->addPosts(
            $eloquentUser->posts->map(fn ($post) => new Post(Uuid::fromString($post->id), $post->content, $user))->toArray()
        );

        return $user;
    }

    public static function createFromUser(User $user)
    {
        self::fromUser($user)->save();
    }

    public static function updateFromUser(User $user): User
    {
        (
            $eloquentUser = self::fromUser(
                $user,
                EloquentUser::find($user->getId()->toString())
            )
        )->save();

        return self::toUser($eloquentUser);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(EloquentPost::class, 'user_id', 'id');
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(
            EloquentUser::class,
            'follows',
            'user_id',
            'following_id'
        );
    }
}
