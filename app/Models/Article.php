<?php

namespace App\Models;

use App\Models\Love;
use App\Models\Save;
use App\Models\User;
use App\Models\View;
use App\Models\Comment;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'author',
        'content',
        'image',
        'status',
        'download_count'
        
    ];

    protected static function booted()
    {
        static::deleting(function ($article) {
            // Delete all notifications related to this article
            DatabaseNotification::where('data->article_id', $article->id)->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }

    public function love()
    {
        return $this->hasMany(Love::class);
    }

    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'target');
    }
    
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
        public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
