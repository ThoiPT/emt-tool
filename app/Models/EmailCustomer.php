<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCustomer extends Model
{
    use HasFactory;
    const TYPE_DEFAULT = '1';
    const TYPE_POTENTIAL = '10';
    protected $fillable = [
        'group_id',
        'customer_name',
        'email',
        'type',
    ];

    public function getTypeNameAttribute() : string {
        switch($this->type){
            case self::TYPE_DEFAULT:
                return "Khách thường";
            case self::TYPE_POTENTIAL:
                return "Khác tiềm năng";
        }
    }

    public function group()
    {
        return $this->belongsTo(EmailGroup::class,'group_id','id');
    }
}
