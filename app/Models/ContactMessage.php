<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    protected static function booted(): void
    {
        static::creating(function (ContactMessage $contactMessage): void {
            $contactMessage->reference_number = (string) Str::uuid();
        });
    }
}