<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiklatPenjenjangan extends Model
{
    protected $table = 'diklat_penjenjangan';
    protected $primaryKey='id';
    public $incrementing = false;

    public function pegawai()
    {
    	return $this->belongsTo('App\Pegawai');
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
