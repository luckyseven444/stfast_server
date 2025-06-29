<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = [
        'journal_id',
        'account_name',
        'debit',
        'credit',
        'description'
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }
  
}
