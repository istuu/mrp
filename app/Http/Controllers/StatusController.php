<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\Unit;
use App\Notifications\MutasiDitolak;
use App\Notifications\ProsesEvaluasi;
use App\Notifications\ButuhEvaluasi;

use App\Models\KeyCompetencies;
use App\Models\DailyCompetencies;

use App\MRP;
use App\Pegawai;
use App\FormasiJabatan;
use App\PenilaianPegawai;
use App\PersonnelArea;
use Carbon\Carbon;

class StatusController extends Controller
{
    public function __construct()
    {
    	return $this->middleware(Unit::class);
    }

    public function index()
    {
        if(request('act')=='req')
        {
           // $fj = auth()->user()->formasi_jabatan->pluck('id')->toArray();
            $mrp = MRP::where('tipe', 2)->where('unit_pengusul', auth()->user()->id)->get();
           // $pegawai = Pegawai::where('formasi_jabatan_id', $fj);
            return view('pages.unit.status_diajukan',compact('mrp'));
        }
        if(request('act')=='minta')
        {
           // $fj = auth()->user()->formasi_jabatan->pluck('id')->toArray();
            $mrp = MRP::where('tipe', 1)->where('unit_pengusul', auth()->user()->id)->get();
           // $pegawai = Pegawai::where('formasi_jabatan_id', $fj);
            return view('pages.unit.status_diajukan',compact('mrp'));
        }
        if(request('act')=='reqjab')
        {
            $mrp = MRP::where('tipe', 3)->where('unit_pengusul', auth()->user()->id)->get();
            return view('pages.unit.status_diajukan',compact('mrp'));
        }
        if(request('act')=='resjab')
        {
            $fj_karir1  = FormasiJabatan::select('id')
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Manajemen Atas');
                                               $query->orWhere('level', '=', 'UI');
                                               $query->orWhere('level', '=', 'UP');
                                               $query->orWhere('level', '=', 'KP');
                                        })
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Manajemen Menengah');
                                               $query->orWhere('level', '=', 'UI');
                                               $query->orWhere('level', '=', 'UP');
                                               $query->orWhere('level', '=', 'KP');
                                        })
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Manajemen Dasar');
                                               $query->orWhere('level', '=', 'UP');
                                        })
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Fungsional I');
                                               $query->orWhere('level', '=', 'UI');
                                               $query->orWhere('level', '=', 'UP');
                                               $query->orWhere('level', '=', 'KP');
                                        })
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Fungsional II');
                                               $query->orWhere('level', '=', 'UI');
                                               $query->orWhere('level', '=', 'UP');
                                               $query->orWhere('level', '=', 'KP');
                                        })
                                        ->get();

            $fj_karir2  = FormasiJabatan::select('id')
                                        ->where('jenjang_sub', '=', 'Fungsional III')
                                        ->where('jenjang_sub', '=', 'Fungsional IV')
                                        ->where('jenjang_sub', '=', 'Fungsional V')
                                        ->where('jenjang_sub', '=', 'Fungsional VI')
                                        ->get();

            $fj_karirkp  = FormasiJabatan::select('id')
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Manajemen Dasar');
                                               $query->orWhere('level', '=', 'UP');
                                        })
                                        ->where('jenjang_sub', '=', 'Fungsional III')
                                        ->where('jenjang_sub', '=', 'Fungsional IV')
                                        ->where('jenjang_sub', '=', 'Fungsional V')
                                        ->where('jenjang_sub', '=', 'Fungsional VI')
                                        ->get();

            if(auth()->user()->user_role == 2){
                $fj = array_pluck($fj_karir1,'id');
                $mrp = MRP::where('tipe', 2)->whereIn('fj_tujuan', $fj)->get();

            }elseif(auth()->user()->user_role == 3) {
                $fj = array_pluck($fj_karir2,'id');
                $mrp = MRP::where('tipe', 2)->whereIn('fj_tujuan', $fj)->get();

            }elseif(auth()->user()->user_role == 4) {
                $fj = array_pluck($fj_karirkp,'id');
                $mrp = MRP::where('tipe', 2)->whereIn('fj_tujuan', $fj)->get();

            }
            elseif(auth()->user()->user_role == 1){
                $fj = auth()->user()->formasi_jabatan->pluck('id')->toArray();
                $mrp = MRP::where('tipe', 2)
                        ->whereIn('fj_tujuan', $fj)
                        ->whereNotIn('fj_tujuan', $fj_karir1)
                        ->whereNotIn('fj_tujuan', $fj_karir2)
                        ->get();

            }else{
                $mrp = MRP::where('tipe', 2)->get();
            }


            return view('pages.unit.status_diterima',compact('mrp'));
            // dd($mrp);
        }
        if(request('act')=='resminta')
        {
            if(auth()->user()->user_role == 4){
                $fj = FormasiJabatan::where('legacy_code','LIKE','1516%')->limit(2000)->get();
                $mrp = MRP::where('tipe', 1)
                        ->whereIn('fj_asal', array_pluck($fj,'id'))
                        ->get();
            }elseif(auth()->user()->user_role == 0){
                $mrp = MRP::where('tipe', 1)->get();
            }else{
                $fj = auth()->user()->formasi_jabatan->pluck('id')->toArray();

                $mrp = MRP::where('tipe', 1)
                ->whereHas('pegawai', function($q) use ($fj){
                    $q->whereIn('fj_asal', $fj);
                })
                ->get();
            }


            return view('pages.unit.status_diterima',compact('mrp'));
            // dd($mrp);
        }

    }

    public function getDetails($reg_num)
    {
        $detail = MRP::where('registry_number', $reg_num)->first();
        $waktunilai = $detail->penilaian_pegawai;

        if($detail->tipe == '3')
        {
           return view('pages.unit.detail_bursa',compact('detail'));
        }
        else if($detail->tipe == '1')
        {
            return view('pages.unit.detail_minta',compact('detail'));
        }

        else if($detail->tipe == '2')
        {
            $keys     = KeyCompetencies::orderBy('sequence')->get();
            $dailys   = DailyCompetencies::orderBy('sequence')->get();
    	   return view('pages.unit.detail_mutasi',compact('detail', 'waktunilai','keys','dailys'));
        }
    }

    // Approve dari Unit
    public function approve()
    {
        $this->validate(request(), [
            'dokumen_unit_jawab' => 'required|mimes:pdf|max:10240'
        ]);

        $Status = MRP::where('registry_number', request('reg_num'))->first();
        // $Status = MRP::find(request('id'));
        $Status->status = 2;
        $Status->no_dokumen_unit_jawab = request('no_dokumen_unit_jawab');
        $Status->tgl_dokumen_unit_jawab = Carbon::now('Asia/Jakarta');

        $file = request('dokumen_unit_jawab');
        $foldername = $Status->registry_number.'/';
        $filename = 'JAWAB_'.Carbon::now('Asia/Jakarta')->year.str_replace('/', '_', $Status->no_dokumen_unit_jawab).'.'.$file->getClientOriginalExtension();
        $Status->filename_dokumen_unit_jawab = $filename;
        // dd($foldername, $filename);
        $file->move(public_path().'/storage/uploads/', $filename);

        $Status->save();
        // $file->move(public_path('storage/uploads/', $filename));

        $pengusul = $Status->personnel_area_pengusul;
        $data = [
            'reg_num' => $Status->registry_number,
            'user_id' => $pengusul->id,
            'mrp_id' => $Status->id
        ];
        $pengusul->notify(new ProsesEvaluasi($data));

        $sdm = PersonnelArea::where('user_role', 3)->first();
        $data = [
            'reg_num' => $Status->registry_number,
            'tipe' => $Status->tipe,
            'user_id' => $pengusul->id,
            'mrp_id' => $Status->id
        ];
        $sdm->notify(new ButuhEvaluasi($data));


        return back()->with('success', 'Status Diubah');
    }

    //Decline dari Unit
    public function decline($reg_num)
    {
        $mrp = MRP::where('registry_number', $reg_num)->first();
        $mrp->update(['status' => 97]);

        $pengusul = $mrp->personnel_area_pengusul;
        $data = [
            'reg_num' => $mrp->registry_number,
            'penolak' => auth()->user()->nama_pendek,
            'user_id' => $pengusul->id,
            'mrp_id' => $mrp->id
        ];
        $pengusul->notify(new MutasiDitolak($data));

        return back()->with('success', 'Status Diubah');
    }

    public function finishMutasi($reg_num)
    {
        $mrp = MRP::where('registry_number', $reg_num)->firstOrFail();
        $mrp->status = 8;
        $mrp->save();

        return back()->with('success', 'Berhasil konfirmasi aktivasi');
    }
}
