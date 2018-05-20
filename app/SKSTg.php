<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SKSTg extends Model
{
    protected $table = 'sk_stg';
    protected $primaryKey='id';
    public $incrementing = false;

    public function mrp()
    {
    	return $this->hasOne('App\MRP', 'skstg_id');
    }

    public function getTglAktivasiAttribute($value)
    {
    	return Carbon::parse($value);
    }

    public function getTglKirimSkAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Get the format for database stored dates.
     *
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }

    /**
     * Convert a DateTime to a storable string.
     * SQL Server will not accept 6 digit second fragment (PHP default: see getDateFormat Y-m-d H:i:s.u)
     * trim three digits off the value returned from the parent.
     *
     * @param  \DateTime|int  $value
     * @return string
     */
    public function fromDateTime($value)
    {
        return substr(parent::fromDateTime($value), 0, -3);
    }
}
