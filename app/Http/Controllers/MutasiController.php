<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\Unit;
use App\Http\Middleware\SDM;
use Carbon\Carbon;
use Uuid;

use App\MRP;
use App\Pegawai;
use App\PenilaianPegawai;
use App\PersonnelArea;
use App\FormasiJabatan;
use App\Models\KeyCompetencies;
use App\Models\DailyCompetencies;

use App\Notifications\PegawaiDibursakan;
use App\Notifications\PegawaiDiproyeksikan;
use App\Notifications\PegawaiDiminta;
use App\Notifications\JabatanDibursakan;

class MutasiController extends Controller
{
    public function __construct()
    {
    	$this->middleware('unit');
    }

    public function index()
    {
    	$tipe = request('tipe');

    	if($tipe === '1')
    	{

            $personnelarea = auth()->user();
            $formasis = $personnelarea->formasi_jabatan()->select('formasi')->distinct()->get()->all();

    		return view('pages.unit.meminta',compact('units','personnelarea','formasis'));
    	}
    	else if($tipe === '2')
    	{
            $units    = PersonnelArea::all();
            $keys     = KeyCompetencies::orderBy('sequence')->get();
            $dailys   = DailyCompetencies::orderBy('sequence')->get();
            $jenjangs = FormasiJabatan::select('jenjang_txt')->groupBy('jenjang_txt')->get();

    		return view('pages.unit.bursa_pegawai', compact('units','keys', 'dailys', 'jenjangs'));
    	}
    	else if($tipe === '3')
    	{
            $personnelarea = auth()->user();
            $formasis = $personnelarea->formasi_jabatan()->select('formasi')->distinct()->get()->all();

    		return view('pages.unit.request_jabatan',compact('personnelarea','formasis'));
    	}
    	else
    	{
    		return abort(404);
    	}
    }

    public function getPegawaiInfo()
    {
        $pegawai = Pegawai::where('nip', request('nip'))->first();
        $user = auth()->user();

        if($pegawai)
        {
            $fj = $pegawai->formasi_jabatan;
            if($fj->personnel_area->id != $user->id && !request('option'))
                return response()->json(NULL);

            $pegawai->forja = $fj->formasi.' '.$fj->jabatan;
            $pegawai->posisi = $fj->posisi;
            $pegawai->personnel_area = $fj->personnel_area->nama;
            $pegawai->masa_kerja = $pegawai->year_diff_decimal(Carbon::parse($pegawai->tanggal_pegawai), Carbon::now('Asia/Jakarta')).' Tahun';
            $pegawai->sisa_masa_kerja = $pegawai->year_diff_decimal(Carbon::now('Asia/Jakarta'), Carbon::parse($pegawai->tanggal_lahir)->addYears(56)).' Tahun';
            $pegawai->lama_menjabat = $pegawai->year_diff_decimal(Carbon::parse($pegawai->start_date), Carbon::now('Asia/Jakarta')).' Tahun';
            $pegawai->kode_olah_forja = $fj->kode_olah;
        }

        return response()->json($pegawai);
    }

    public function getFormasi()
    {
        $unit = PersonnelArea::find(request('unit_id'));

        if($unit)
        {
            $retval = $unit->formasi_jabatan()->select('formasi')->distinct()->get()->all();
            return response()->json($retval);
        }
        else
            return response()->json(NULL);
    }

    public function getJabatan()
    {
        $unit = PersonnelArea::find(request('unit_id'));

        if($unit)
        {
            $retval = $unit->formasi_jabatan->where('formasi', request('formasi'))->where('kode_olah', '!=', request('kode_olah'))->pluck('jabatan', 'kode_olah')->toArray();
            return response()->json($retval);
        }
        else
            return response()->json(NULL);
    }

    //request jabatan

    public function getFormasiJabs()
    {
        $unit = auth()->user();

        if($unit)
        {
            $retval = $unit->formasi_jabatan->where('formasi', request('formasi'))->where('kode_olah', '!=', request('kode_olah'))->pluck('jabatan', 'kode_olah')->toArray();
            return response()->json($retval);
        }
        else
            return response()->json(NULL);
    }

    public function getJabatanInfo()
    {
        $jabatans = FormasiJabatan::where('kode_olah', request('jabatan_id'))->first();

        return response()->json($jabatans);

    }

    //

    public function submitForm()
    {
        $tipe = request('mrp')['tipe'];
        $nip = request('nip');
        $user = auth()->user();

        if($tipe === '1')
        {
            $this->validate(request(), [
                'file_dokumen_mutasi' => 'required|mimes:pdf|max:50240'
            ]);

            $pegawai = Pegawai::where('nip', $nip)->first();

            if(request('rekom_checkbox') === '1')
                $id_proyeksi = FormasiJabatan::select('id')->where('kode_olah', request('kode_olah'))->first()->id;
            else
                $id_proyeksi = NULL;

            $tambahan_mrp = array(
                'id' => Uuid::generate(),
                'registry_number' => $nip.'.L.'.Carbon::now('Asia/Jakarta'),
                'status' => 1,
                'nip_operator' => request()->session()->get('nip_operator'),
                'unit_pengusul' => $user->id,
                'pegawai_id' => $pegawai->id,
                'fj_asal' => $pegawai->formasi_jabatan->id,
                'fj_tujuan' => $id_proyeksi,
            );

            $data_mrp = array_merge($tambahan_mrp, request('mrp'));

            $mrp = MRP::create($data_mrp);

            $file = request('file_dokumen_mutasi');
            $foldername = $mrp->registry_number.'/';
            $filename = 'USUL_'.Carbon::now('Asia/Jakarta')->year.'_'.str_replace('/', '_', $mrp->no_dokumen_unit_usul).'.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/storage/uploads/', $filename);
            $mrp->filename_dokumen_unit_usul = $filename;
            $mrp->save();

            $data = array(
                'user_id' => $user->id,
                'nama_pendek' => $user->nama_pendek,
                'mrp_id' => $mrp->id->string,
                'nip' => $nip
            );
            $pegawai->formasi_jabatan->personnel_area->notify(new PegawaiDiminta($data));

            return redirect('/status/detail/'.$mrp->registry_number)->with('success', 'Berhasil Meminta Pegawai');
        }

        else if($tipe === '2')
        {
            $this->validate(request(), [
            'file_dokumen_mutasi' => 'required|mimes:pdf|max:10240'
            ]);

            $pegawai = Pegawai::where('nip', $nip)->first();

            if(request('rekom_checkbox') === '1')
                $id_proyeksi = FormasiJabatan::select('id')->where('kode_olah', request('kode_olah'))->first()->id;
            else
                $id_proyeksi = NULL;

            $tambahan_mrp = array(
                'id' => Uuid::generate(),
                'registry_number' => $nip.'.'.request('mrp')["mutasi"][0].'.'.Carbon::now('Asia/Jakarta'),
                'status' => 1,
                'nip_operator' => request()->session()->get('nip_operator'),
                'unit_pengusul' => $user->id,
                'pegawai_id' => $pegawai->id,
                'fj_asal' => $pegawai->formasi_jabatan->id,
                'fj_tujuan' => $id_proyeksi,
            );
            // dd(request('nilai')['hubungan_sesama']);

            $data_mrp = array_merge($tambahan_mrp, request('mrp'));
            $data_nilai = array_merge(request('nilai'), array('pegawai_id' => $pegawai->id, 'mrp_id' => $data_mrp['id']));;
            $data_nilai['hubungan_sesama'] = request('hds').'-'.$data_nilai['hubungan_sesama'];
            $data_nilai['hubungan_atasan'] = request('hda').'-'.$data_nilai['hubungan_atasan'];
            // dd($data_mrp, $data_nilai, request('hds'));

            $mrp = MRP::create($data_mrp);
            $nilai = PenilaianPegawai::create($data_nilai);

            $file = request('file_dokumen_mutasi');
            $foldername = $mrp->registry_number.'/';
            $filename = 'USUL_'.Carbon::now('Asia/Jakarta')->year.'_'.str_replace('/', '_', $mrp->no_dokumen_unit_usul).'.'.$file->getClientOriginalExtension();
            // dd($foldername, $filename);
            $file->move(public_path().'/storage/uploads/', $filename);
            $mrp->filename_dokumen_unit_usul = $filename;
            $mrp->save();

            $user_sdm = PersonnelArea::where('user_role', 3)->first();
            $data = array(
                'user_id' => $user->id,
                'nama_pendek' => $user->nama_pendek,
                'mrp_id' => $mrp->id->string,
                'nip' => $nip
            );
            $user_sdm->notify(new PegawaiDibursakan($data));

            if($id_proyeksi)
            {
                $fj_proyeksi = FormasiJabatan::find($id_proyeksi);
                $data['formasi_jabatan'] = $fj_proyeksi->formasi.' '.$fj_proyeksi->jabatan;

                $user_proyeksi = $fj_proyeksi->personnel_area;
                $user_proyeksi->notify(new PegawaiDiproyeksikan($data));
            }

            return redirect('/status/detail/'.$mrp->registry_number)->with('success', 'Pegawai berhasil dibursakan');
        }
        else if($tipe === '3')
        {
            //dd(request()->all());

            $this->validate(request(), [
                'file_dokumen_mutasi' => 'required|mimes:pdf|max:10240'
            ]);

            $jabatan = FormasiJabatan::select('id')->where('kode_olah', request('kode_olah'))->first();

            $input_mrp = array(
                'id' => Uuid::generate(),
                'registry_number' => $jabatan->kode_olah.'.Request.'.Carbon::now('Asia/Jakarta'),
                'status' => 1,
                'nip_operator' => request()->session()->get('nip_operator'),
                'unit_pengusul' => $user->id,
                'fj_tujuan' => $jabatan->id,
            );

            $data_mrp = array_merge($input_mrp, request('mrp'));

            $mrp = MRP::create($data_mrp);

            $file = request('file_dokumen_mutasi');
            $foldername = $mrp->registry_number.'/';
            $filename = 'USUL_'.Carbon::now('Asia/Jakarta')->year.'_'.str_replace('/', '.', $mrp->no_dokumen_unit_usul).'.'.$file->getClientOriginalExtension();

            $file->move(public_path().'/storage/uploads/', $filename);
            $mrp->filename_dokumen_unit_usul = $filename;
            $mrp->save();

            $user_sdm = PersonnelArea::where('user_role', 3)->first();
            $data = array(
                'user_id' => $user->id,
                'nama_pendek' => $user->nama_pendek,
                'mrp_id' => $mrp->id->string,
                'formasi_jabatan' => $jabatan->formasi.' '.$jabatan->jabatan,
                'formasi_jabatan_id' => $jabatan->id
            );
            // kurang yang ke semua unit
            $user_sdm->notify(new JabatanDibursakan($data));

            return redirect('/status/detail/'.$mrp->registry_number)->with('success', 'Berhasil Bursa Jabatan');

        }
    }
}
