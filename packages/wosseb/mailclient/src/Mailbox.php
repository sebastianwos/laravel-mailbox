<?php

namespace Wosseb\Mailclient;

use Illuminate\Database\Eloquent\Model;

class Mailbox extends Model
{
    protected $fillable = ['name'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
