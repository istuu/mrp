<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianPegawai extends Model
{
    protected $table = 'penilaian_pegawai';
    protected $guarded = ['id'];

    public function aspek_penilaian()
    {
    	return $this->belongsTo('App\AspekPenilaian');
    }

    public function mrp()
    {
        return $this->hasOne('App\MRP', 'mrp_id');
    }

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
