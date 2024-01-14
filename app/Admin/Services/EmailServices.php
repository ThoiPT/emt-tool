<?php
namespace App\Admin\Services;

use App\Models\EmailCustomer;
use App\Models\EmailGroup;
use App\Models\EmailTemplate;

class EmailServices
{
    public static function getOptionGroup()
    {
        return EmailGroup::pluck('name','id');
    }

    public static function getOptionType()
    {
        return [
            EmailCustomer::TYPE_DEFAULT => "Khách thường",
            EmailCustomer::TYPE_POTENTIAL => "Khách tiềm năng",
        ];
    }

    public static function getTemplateMail(){
        return EmailTemplate::all();
    }
}
