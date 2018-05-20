<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormasiJabatan extends Model
{
    protected $table = 'formasi_jabatan';
	protected $primaryKey='id';
    public $incrementing = false;

    public function personnel_area()
    {
    	return $this->belongsTo('App\PersonnelArea');
    }

    public function pegawai()
    {
    	return $this->hasMany('App\Pegawai');
    }

    public function mrp_tujuan()
    {
        return $this->hasMany('App\MRP', 'fj_tujuan');
    }

    public function mrp_asal()
    {
        return $this->hasMany('App\MRP', 'fj_asal');
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
