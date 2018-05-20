<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MRP extends Model
{
    protected $table = 'mrp';
    protected $primaryKey='id';
    public $incrementing = false;

    protected $guarded = [];

    public function pegawai()
    {
    	return $this->belongsTo('App\Pegawai');
    }

    public function pegawai_pengusul()
    {
        return $this->belongsTo('App\Pegawai', 'nip_pengusul', 'nip');
    }

    public function pegawai_operator()
    {
        return $this->belongsTo('App\Pegawai', 'nip_operator', 'nip');
    }

    public function penilaian_pegawai()
    {
        return $this->hasOne('App\PenilaianPegawai', 'mrp_id');
    }

    public function skstg()
    {
    	return $this->hasOne('App\SKSTg', 'mrp_id');
    }

    public function formasi_jabatan_tujuan()
    {
    	return $this->belongsTo('App\FormasiJabatan', 'fj_tujuan');
    }

    public function formasi_jabatan_asal()
    {
        return $this->belongsTo('App\FormasiJabatan', 'fj_asal');
    }

    public function personnel_area_pengusul()
    {
        return $this->belongsTo('App\PersonnelArea', 'unit_pengusul');
    }

    public function getRequestedTglAktivasiAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getTglPoolingAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getTglEvaluasiAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getTglDokumenMutasiAttribute($value)
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
