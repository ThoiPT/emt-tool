<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','status','group_indentify'
    ];

    public function customers()
    {
        return $this->hasMany(EmailCustomer::class,'group_id','id');
    }
}
