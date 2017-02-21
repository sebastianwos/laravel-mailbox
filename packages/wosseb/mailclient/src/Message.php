<?php

namespace Wosseb\Mailclient;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'mailbox_id',
        'message_id',
        'message_number',
        'subject',
        'body_html',
        'body_text',
        'from',
        'to',
        'date',
        'answered',
        'deleted',
        'seen',
        'draft',
    ];

    protected $dates = [
        'date'
    ];

    public function mailbox()
    {
        return $this->belongsTo(Mailbox::class);
    }

}
