<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JournalEntry;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Journal extends Model
{
    protected $fillable = [
        'type'
    ];

    public function entries(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }

}
