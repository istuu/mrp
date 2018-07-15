<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Middleware\SDM;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Table;

use App\MRP;
use App\Pegawai;
use App\PersonnelArea;
use App\FormasiJabatan;
use App\SKSTg;
use Uuid;

class MRPController extends AdminController
{
    public function __construct()
    {
    	return $this->middleware(SDM::class);
    }

    public function index()
    {
    	return view('pages.sdm.mrp');
    }

    public function showEdit()
    {
        $mrp = MRP::where('registry_number', request('reg_num'))->firstOrFail();
        $all_unit = PersonnelArea::select('id', 'personnel_area')->get()->all();
        $pengusul = Pegawai::where('nip', $mrp->nip_pengusul)->first();
        $operator = Pegawai::where('nip', $mrp->nip_operator)->first();
        $fj_tujuan = $mrp->formasi_jabatan_tujuan;
        if ($fj_tujuan)
        {
            $unit_tujuan = $fj_tujuan->personnel_area;
            $formasi = $unit_tujuan->formasi_jabatan;
            $formasi_selected = $fj_tujuan->formasi;
            $jabatan = $unit_tujuan->formasi_jabatan()->where('formasi', $formasi_selected)->get();
            $jabatan_selected = $fj_tujuan->jabatan;
        }
        else
            $unit_tujuan = NULL;

        // dd($mrp->mutasi == 'Rotasi');

    	return view('pages.sdm.mrp_edit', compact('mrp', 'fj_tujuan', 'unit_tujuan', 'all_unit', 'pengusul', 'operator', 'formasi', 'jabatan', 'formasi_selected', 'jabatan_selected'));
    }

    public function edit()
    {
        $mrp = MRP::find(request('mrp_id'));
        $pegawai = Pegawai::where('nip', request('nip'))->first();
        $fj_tujuan = FormasiJabatan::where('kode_olah', request('kode_olah'))->first()->id;
        $data = array_merge(request('mrp'), [
            'pegawai_id' => $pegawai->id,
            'fj_tujuan' => $fj_tujuan
        ]);
        // dd($data);
        $mrp->update($data);

        if(request('unit_asal_attachment'))
        {
            $file = request('unit_asal_attachment');
            $foldername = $mrp->registry_number.'/';
            $filename = 'pengusul_'.str_replace('/', '_', $mrp->no_dokumen_unit_asal).'.'.$file->getClientOriginalExtension();
            // dd($foldername, $filename);
            // $file->move(base_path(). '/storage/uploads/dok_asal/'.$foldername, $filename);
            $file->move(public_path().'/storage/uploads/', $filename);
        }

        if(request('unit_mutasi_attachment'))
        {
            $file = request('unit_mutasi_attachment');
            $foldername = $mrp->registry_number.'/';
            $filename = 'balasan_'.str_replace('/', '_', $mrp->no_dokumen_unit_asal).'.'.$file->getClientOriginalExtension();
            // dd($foldername, $filename);
            // $file->move(base_path(). '/storage/uploads/dok_asal/'.$foldername, $filename);
            $file->move(public_path().'/storage/uploads/', $filename);
        }

        return redirect('/mrp')->with('success', 'Data berhasil di update');
    }

    public function showDetail()
    {
        $mrp = MRP::where('registry_number', request('reg_num'))->firstOrFail();
        $pengusul = $mrp->personnel_area_pengusul;
        $skstg = $mrp->skstg;

        if ($mrp->tipe == 3)
        {
            $jabatan = $mrp->formasi_jabatan;
            return view('pages.sdm.mrp_detail_bursa_jabatan', compact('mrp', 'pengusul', 'skstg', 'jabatan'));
        }

        $proyeksi = $mrp->formasi_jabatan_tujuan;
        $pegawai = $mrp->pegawai;
        $sutri = $pegawai ? $pegawai->sutri : NULL;

        return view('pages.sdm.mrp_detail', compact('mrp', 'pegawai', 'sutri', 'proyeksi', 'pengusul', 'skstg'));
    }

    public function downloadDokumen($reg_num, $no_dokumen)
    {
        $path = public_path().'storage/uploads/'.$no_dokumen.'.pdf';

        return response()->download($path);
    }

    public function getStatus($status, $withHTML = false)
    {
        if($withHTML)
        {
            if($status == 0)
                $retval = '<span class="label label-danger">Ditolak</span>';
            else if($status == 1)
                $retval = '<span class="label label-primary">Diajukan</span>';
            else if($status == 2)
                $retval = '<span class="label label-warning">Proses Evaluasi</span>';
            else if($status == 3)
                $retval = '<span class="label label-warning">Proses Evaluasi</span>';
            else if($status == 4)
                $retval = '<span class="label label-success">Proses SK</span>';
            else if($status == 5)
                $retval = '<span class="label label-success">SK Tercetak</span>';
            else if($status == 6)
                $retval = '<span class="label label-success">SK Pending</span>';
            else if($status == 7)
                $retval = '<span class="label label-success">Lewat Masa Aktivasi (unconfirmed)</span>';
            else if($status == 8)
                $retval = '<span class="label label-success">Clear</span>';
            else if($status == 99)
                $retval = '<span class="label label-danger">Ditolak (SDM Pusat)</span>';
            else if($status == 98)
                $retval = '<span class="label label-danger">Ditolak (SDM Pusat)</span>';
            else if($status == 97)
                $retval = '<span class="label label-danger">Ditolak (Unit)</span>';
            else
                $retval = '<span class="label label-danger">???</span>';
        }
        else
        {
            if($status == 0)
                $retval = 'Ditolak';
            else if($status == 1)
                $retval = 'Diajukan';
            else if($status == 2)
                $retval = 'Proses Evaluasi (SDM)';
            else if($status == 3)
                $retval = 'Proses Evaluasi (Karir II)';
            else if($status == 4)
                $retval = 'Proses SK';
            else if($status == 5)
                $retval = 'SK Tercetak';
            else if($status == 6)
                $retval = 'SK Pending';
            else if($status == 7)
                $retval = 'Lewat Masa Aktifasi (unconfirmed)';
            else if($status == 8)
                $retval = 'Clear';
            else if($status == 99)
                $retval = 'Ditolak (SDM Pusat)';
            else if($status == 98)
                $retval = 'Ditolak (SDM Pusat)';
            else if($status == 97)
                $retval = 'Ditolak (Unit)';
            else
                $retval = '???';
        }


        return $retval;
    }

    public function export()
    {
        $filename = 'MRP-export-'.Carbon::now('Asia/Jakarta');
        $mrps = MRP::all();

        $data = [];

        foreach ($mrps as $key => $mrp)
        {
            $pegawai = $mrp->pegawai;
            $formasi_jabatan = $mrp->formasi_jabatan_asal ? $mrp->formasi_jabatan_asal : NULL;
            $fj_tujuan = $mrp->formasi_jabatan_tujuan;
            $sutri = $pegawai ? $pegawai->sutri : NULL;
            $diklat = $pegawai ? $pegawai->diklat_penjenjangan->first() : NULL;
            $skstg = $mrp->skstg;

            $arr = [
                'Registry Number' => $mrp->registry_number,
                'Status Proses' => $this->getStatus($mrp->status),
                'Fitur' => $mrp->tipe,
                'Source' => 'Existing',
                'Jenis Mutasi' => $mrp->jenis_mutasi,
                'Mutasi' => $mrp->mutasi,
                'Jalur Mutasi (pengembangan)' => $mrp->jalur_mutasi,
                'Perner' => $pegawai ? $pegawai->perner : NULL,
                'NIP' => $pegawai ? $pegawai->nip : NULL,
                'Nama Pegawai' => $pegawai ? $pegawai->nama_pegawai : NULL,
                'No Dokumen Usul' => $mrp->no_dokumen_unit_usul,
                'Tgl. Dokumen' => $mrp->tgl_dokumen_unit_usul,
                'PS Group' => $pegawai ? $pegawai->ps_group : NULL,
                'Jenjang' => $formasi_jabatan ? $formasi_jabatan->jenjang_txt : NULL,
                'Formasi' => $formasi_jabatan ? $formasi_jabatan->formasi : NULL,
                'Jabatan' => $formasi_jabatan ? $formasi_jabatan->jabatan : NULL,
                'SPFJ' => $formasi_jabatan ? $formasi_jabatan->spfj : NULL,
                'Legacy Code' => $formasi_jabatan ? $formasi_jabatan->legacy_code : NULL,
                'Personnel Area' => $formasi_jabatan ? $formasi_jabatan->personnel_area->nama : NULL,
                'Company Code' => '?',
                'Jenjang Tujuan' => $fj_tujuan ? $fj_tujuan->jenjang_txt : NULL,
                'Formasi Tujuan' => $fj_tujuan ? $fj_tujuan->formasi : NULL,
                'Jabatan Tujuan' => $fj_tujuan ? $fj_tujuan->jabatan : NULL,
                'SPFJ Tujuan' => $fj_tujuan ? $fj_tujuan->spfj : NULL,
                'Legacy Code Tujuan' => $fj_tujuan ? $fj_tujuan->legacy_code : NULL,
                'Personnel Area Tujuan' => $fj_tujuan ? $fj_tujuan->personnel_area->nama : NULL,
                'Company Code Tujuan' => '?',
                'Tgl. Lahir' => $pegawai ? $pegawai->tgl_lahir : NULL,
                'Sisa Masa Kerja' => $pegawai ? $pegawai->year_diff_decimal(Carbon::now('Asia/Jakarta'), Carbon::parse($pegawai->tgl_lahir)->addYears(56)) : NULL,
                'Masa Kerja Jbtn. Terakhir' => $pegawai ? $pegawai->year_diff_decimal(Carbon::parse($pegawai->start_date), Carbon::now('Asia/Jakarta')) : NULL,
                'Sutri' => $sutri ? 'PLN' : 'Non-PLN',
                'NIP Sutri' => $sutri ? $sutri->nip : NULL,
                'Nama Sutri' => $sutri ? $sutri->nama_pegawai : NULL,
                'Personnel Area Sutri' => $sutri ? $sutri->formasi_jabatan->personnel_area->nama : NULL,
                'Status Evaluasi Sutri (pengembangan)' => NULL,
                'Diklat Penjejangan' => $diklat ? $diklat->jenis_diklat : NULL,
                'No. Sertifikat' =>  $diklat ? $diklat->nomor_sertifikat : NULL,
                'Tgl. Sertifikat' =>  $diklat ? $diklat->tgl_lulus : NULL,
                'Status Domisili (pengembangan)' => NULL,
                'No. Dokumen Jawab Unit' => $mrp->no_dokumen_unit_jawab,
                'Tgl. Dokumen Jawab Unit' => $mrp->tgl_dokumen_unit_jawab,
                'No. Dokumen Respon SDM' => $mrp->no_dokumen_respon_sdm,
                'Tgl. Evaluasi' => $mrp->tgl_evaluasi,
                'No. SK' => $skstg ? $skstg->no_sk : NULL,
                'No. STg' => $skstg ? $skstg->no_stg : NULL,
                'No. Dokumen Kirim SK' => $skstg ? $skstg->no_dokumen_kirim_sk : NULL,
                'Tgl. Kirim SK' => $skstg ? $skstg->tgl_kirim_sk : NULL,
                'Tgl. Aktivasi SK' => $skstg ? $skstg->tgl_aktivasi : NULL,
            ];

            array_push($data, $arr);
        }

        Excel::create($filename, function($excel) use($data) {
            $excel->sheet('MRP', function($sheet) use($data) {
                $column_range = 'A1:AV1';

                $sheet->freezeFirstRow();
                $sheet->setAutoFilter($column_range);
                $sheet->cell($column_range, function($row) {
                    $row->setBackground('#d3d3d3');
                    $row->setAlignment('center');
                });
                $sheet->setColumnFormat(array(
                    'L' => 'dd/mm/yy',
                    'AB' => 'dd/mm/yy',
                    'AL' => 'dd/mm/yy',
                    'AO' => 'dd/mm/yy',
                    'AP' => 'dd/mm/yy',
                    'AU' => 'dd/mm/yy',
                ));
                // $sheet->row(1, function($row) {
                //     $row->setBackground('#d3d3d3');
                //     $row->setAlignment('center');
                // });
                $sheet->with($data);
            });
        })->download('xlsx');

        return redirect('/mrp');
    }

    public function ajaxDatatables(Request $request)
    {
        //Isi dengan kolom
        $columns = array(
            0 =>'created_at',
            1=> 'registry_number',
            2=> 'nama_pegawai',
            3=> 'tipe',
            4=> 'unit_pengusul',
            5=> 'status',
            6=> 'action'
        );

        //<-- Gak Perlu Diubah -->
        $totalData = MRP::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $mrps = MRP::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value');

        //<-- Gak Perlu Diubah END -->
        //Tambah orWhere di kolom yang akan dijadikan di search
            $mrps =  MRP::where('registry_number', 'LIKE',"%{$search}%")
                            ->orWhereHas('pegawai', function($query) use ($search){
                                $query->where('nama_pegawai', 'LIKE', "%{$search}%");
                            })
                            ->orWhereHas('personnel_area_pengusul', function($query) use ($search){
                                $query->where('nama', 'LIKE', "%{$search}%");
                            })
                            // ->orWhere('created_at', $search)
                            ->offset($start)
                            ->limit($limit)
                            // ->with(['pegawai:id,nip,nama_pegawai', 'personnel_area_pengusul:id,nama'])
                            ->orderBy($order,$dir)
                            ->get();
        //Tambah orWhere di kolom yang akan dijadikan di search
            $totalFiltered = MRP::where('registry_number', 'LIKE',"%{$search}%")
                                    ->orWhereHas('pegawai', function($query) use ($search){
                                        $query->where('nama_pegawai', 'LIKE', "%{$search}%");
                                    })
                                    ->orWhereHas('personnel_area_pengusul', function($query) use ($search){
                                        $query->where('nama', 'LIKE', "%{$search}%");
                                    })
                                    // ->orWhere('created_at', $search)
                                    ->count();
        }

        if(auth()->user()->user_role == 2){
            //Karir 1
            $fj_asal  = FormasiJabatan::select('id')
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

            $fj_tujuan  = FormasiJabatan::select('id')
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

            $mrps = $mrps->whereIn('fj_asal',array_pluck($fj_asal,'id'))
                         ->whereIn('fj_tujuan',array_prepend(array_pluck($fj_tujuan,'id'),null));

        }elseif (auth()->user()->user_role == 3) {
            //Karir 2
            $fj_asal  = FormasiJabatan::select('id')
                                        ->where('jenjang_sub','Fungsional III')
                                        ->orWhere('jenjang_sub','Fungsional IV')
                                        ->orWhere('jenjang_sub','Fungsional V')
                                        ->orWhere('jenjang_sub','Fungsional VI')
                                        ->get();

            $fj_tujuan  = FormasiJabatan::select('id')
                                        ->where('jenjang_sub','Fungsional III')
                                        ->orWhere('jenjang_sub','Fungsional IV')
                                        ->orWhere('jenjang_sub','Fungsional V')
                                        ->orWhere('jenjang_sub','Fungsional VI')
                                        ->get();

            $mrps = $mrps->whereIn('fj_asal',array_pluck($fj_asal,'id'))
                         ->whereIn('fj_tujuan',array_prepend(array_pluck($fj_tujuan,'id'),null));

        }elseif (auth()->user()->user_role == 4) {
            //Karir 2
            $fj_asal  = FormasiJabatan::select('id')
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Manajemen Dasar');
                                               $query->orWhere('level', '=', 'KP');
                                        })
                                        ->where('jenjang_sub','Fungsional III')
                                        ->orWhere('jenjang_sub','Fungsional IV')
                                        ->orWhere('jenjang_sub','Fungsional V')
                                        ->orWhere('jenjang_sub','Fungsional VI')
                                        ->get();

            $fj_tujuan  = FormasiJabatan::select('id')
                                        ->where(function($query){
                                               $query->where('jenjang_sub', '=', 'Manajemen Dasar');
                                               $query->orWhere('level', '=', 'KP');
                                        })
                                        ->where('jenjang_sub','Fungsional III')
                                        ->orWhere('jenjang_sub','Fungsional IV')
                                        ->orWhere('jenjang_sub','Fungsional V')
                                        ->orWhere('jenjang_sub','Fungsional VI')
                                        ->get();

            $mrps = $mrps->whereIn('fj_asal',array_pluck($fj_asal,'id'))
                         ->whereIn('fj_tujuan',array_prepend(array_pluck($fj_tujuan,'id'),null));
        }

        $data = array();
        if(!empty($mrps))
        {
            foreach ($mrps as $mrp)
            {
                //Apa yang akan ditampilkan di tiap2 row
                $nestedData['registry_number'] = $mrp->registry_number;
                $nestedData['nama_pegawai'] = $mrp->pegawai ? $mrp->pegawai->nama_pegawai : NULL;
                $nestedData['tipe'] = $mrp->tipe;

                $nestedData['status'] = $this->getStatus($mrp->status, true);

                $nestedData['unit_pengusul'] = $mrp->personnel_area_pengusul->nama;
                $nestedData['created_at'] = $mrp->created_at->format("d F Y h:i:s");
                if($mrp->status == 2){
                    $nestedData['action'] =
                    '
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">Action <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a type="button" data-toggle="modal" data-target="#approveModal" onclick="rejectApproveFunct('.$mrp->id.', '.$mrp->registry_number.');">
                                <i class="fa fa-check-circle"></i>
                                <span>Approve</span>
                            </a>
                        </li>
                        <li>
                            <a type="button" data-toggle="modal" data-target="#rejectModal" onclick="rejectApproveFunct('.$mrp->id.', '.$mrp->registry_number.');">
                                <i class="fa fa-minus-circle"></i>
                                <span>Reject</span>
                            </a>
                        </li>
                        <li>
                            <a href="/mrp/edit/'.$mrp->registry_number.'">
                                <i class="fa fa-pencil-square-o"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a href="/mrp/detail/'.$mrp->registry_number.'" target="_blank">
                                <i class="fa fa-list"></i> Detail
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </li>
                    </ul>
                    </div>
                    ';
                }else{
                    $nestedData['action'] =
                    '
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">Action <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="/mrp/edit/'.$mrp->registry_number.'">
                                <i class="fa fa-pencil-square-o"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a href="/mrp/detail/'.$mrp->registry_number.'" target="_blank">
                                <i class="fa fa-list"></i> Detail
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </li>
                    </ul>
                    </div>
                    ';
                }

                // ID setter, untuk keperluan ajax delete
                $nestedData['DT_RowId'] = $mrp->id;


                $data[] = $nestedData;

            }
        }

        //<-- Gak Perlu Diubah -->
        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        return json_encode($json_data);
        //<-- Gak Perlu Diubah END -->
    }
}
