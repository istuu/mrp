<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legacy extends Model
{
    public $guarded = [];

    /**
    * @return string date format for mssql
    */
   protected function getDateFormat()
   {
       return 'Y-m-d H:i:s.u0';
   }
}
