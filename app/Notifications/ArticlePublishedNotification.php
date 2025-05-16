<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ArticlePublishedNotification extends Notification
{
    protected $article;
    protected $type;
    protected $actor;

    public function __construct($article, $type = 'publish',$actor)
    {
        $this->article = $article;
        $this->type = $type;
        $this->actor = $actor;
    }

    // ✅ REQUIRED: tells Laravel to store this in the database
    public function via($notifiable)
    {
        return ['database'];
    }

    // ✅ Formats the notification data stored in the database
    public function toDatabase($notifiable)
    {
        return [
        'title' => "{$this->article->title}",
        'message' => "{$this->actor->name} {$this->type}",
        'type' => $this->type,
        'article_id' => $this->article->id ?? null,
        'blogger_id' => $this->article->user_id ?? null,
        'actor_name' => $this->actor->name, // ✅ Add this line
    ];
    }
}
