<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Record;

class Wallet extends Model
{
    protected $fillable = [
        'name', 'type',
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}