<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInformations extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function addresses()
    {
        return $this->hasMany(Address::class, 'customer_id');
    }
}
