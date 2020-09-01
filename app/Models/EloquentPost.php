<?php

namespace App\Models;

use App\EloquentUser;
use Domain\SSN\Posts\Entity\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EloquentPost extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'content'
    ];

    public static function createFromPost(Post $post)
    {
        $author = EloquentUser::where('email', $post->getAuthor()->getEmail())->first();
        $author->posts()->create([
            'content' => $post->getContent()
        ]);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class);
    }
}