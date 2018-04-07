<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\SDM;
use Uuid;
use App\Notifications\SKTercetak;
use App\MRP;
use App\SKSTg;
use App\Pegawai;

class SKController extends Controller
{
	public function __construct()
	{
		return $this->middleware(SDM::class);
	}

    public function index()
    {
        $mrpsk = MRP::where('status', 4)->get();
        return view('pages.sdm.sk', compact('mrpsk'));
    }

    public function uploadSK(Request $request)
    {

        $this->validate($request, [
			'file_dokumen_sk' => 'mimes:pdf|max:10240',
            'file_dokumen_stg' => 'mimes:pdf|max:10240',
        ]);

        $mrp = MRP::findOrFail($request->input('mrp_id'));
		$pegawai = Pegawai::findOrFail($mrp->pegawai_id);
        $skstg = new SKSTg;

        $skstg->id=Uuid::generate();
        $skstg->tahun_sk=$request->input('tahun_sk');
        $skstg->no_sk=$request->input('no_sk');
        $skstg->no_dokumen_kirim_sk=$request->input('no_dokumen_kirim_sk');
        $skstg->tgl_kirim_sk=$request->input('tgl_kirim_sk');
        $skstg->tgl_aktivasi=$request->input('tgl_aktivasi');

		$skstg->tahun_stg=$request->input('tahun_stg');
        $skstg->no_stg=$request->input('no_stg');
        $skstg->tgl_aktivasi_stg=$request->input('tgl_aktivasi_stg');


        $skstg->mrp_id=$mrp->id;
		if(isset($request->file_dokumen_sk)){
			$file = $request->file('file_dokumen_sk');
			$foldername = $mrp->registry_number.'/';
			$filename = 'SK_'.$skstg->tahun_sk.'_'.str_replace('/', '_', $skstg->no_sk).'-'.$pegawai->nama_pegawai.'-'.$pegawai->nip.'-'.$mrp->mutasi.'.'.$file->getClientOriginalExtension();
			$file->move(public_path().'/storage/uploads/', $filename);
			$skstg->filename_dokumen_sk = $filename;
		}

		if(isset($request->file_dokumen_stg)){
			$file = $request->file('file_dokumen_stg');
			$foldername = $mrp->registry_number.'/';
			$filename = 'STg_'.$skstg->tahun_sk.'_'.str_replace('/', '_', $skstg->no_sk).'-'.$pegawai->nama_pegawai.'-'.$pegawai->nip.'-'.$mrp->mutasi.'.'.$file->getClientOriginalExtension();
			$file->move(public_path().'/storage/uploads/', $filename);
			$skstg->no_stg = $filename;
		}

        $skstg->save();

        $mrp->skstg_id = $skstg->id;
        $mrp->status = 5;
        $mrp->save();

        $pengusul = $mrp->personnel_area_pengusul;

        // dd($pengusul);

        $data = [
            'reg_num' => $mrp->registry_number,
            'user_id' => $pengusul->id,
            'mrp_id' => $mrp->id
        ];

        $pengusul->notify(new SKTercetak($data));

        return redirect('/sk')->with('success', 'SK Berhasil Diupload');
    }

    public function ajaxDatatables(Request $request)
    {
        //Isi dengan kolom
        $columns = array(
            0 =>'no_sk',
            1=> 'no_stg',
            2=> 'tahun_sk',
            3=> 'no_dokumen_kirim_sk',
            4=> 'tgl_kirim_sk',
            5=> 'tgl_aktivasi',
            6=> 'dokumen'
        );

        //<-- Gak Perlu Diubah -->
        $totalData = SKSTg::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $skstgs = SKSTg::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value');

        //<-- Gak Perlu Diubah END -->
        //Tambah orWhere di kolom yang akan dijadikan di search
            $skstgs =  SKSTg::where('no_sk', 'LIKE',"%{$search}%")
                            ->orWhere('no_stg', 'LIKE',"%{$search}%")
                            ->orWhere('tahun_sk', 'LIKE',"%{$search}%")
                            ->orWhere('no_dokumen_kirim_sk', 'LIKE',"%{$search}%")
                            ->orWhere('tgl_kirim_sk', 'LIKE',"%{$search}%")
                            ->orWhere('tgl_aktivasi', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        //Tambah orWhere di kolom yang akan dijadikan di search
            $totalFiltered = SKSTg::where('no_sk', 'LIKE',"%{$search}%")
                                    ->orWhere('no_stg', 'LIKE',"%{$search}%")
                                    ->orWhere('tahun_sk', 'LIKE',"%{$search}%")
                                    ->orWhere('no_dokumen_kirim_sk', 'LIKE',"%{$search}%")
                                    ->orWhere('tgl_kirim_sk', 'LIKE',"%{$search}%")
                                    ->orWhere('tgl_aktivasi', 'LIKE',"%{$search}%")
                                    ->count();
        }

        $data = array();
        if(!empty($skstgs))
        {
            foreach ($skstgs as $skstg)
            {
                //Apa yang akan ditampilkan di tiap2 row
                $nestedData['no_sk'] = $skstg->no_sk;
                $nestedData['no_stg'] = $skstg->no_stg ? $skstg->no_stg : '-';
                $nestedData['tahun_sk'] = $skstg->tahun_sk;
                $nestedData['no_dokumen_kirim_sk'] = $skstg->no_dokumen_kirim_sk;
                $nestedData['tgl_kirim_sk'] = $skstg->tgl_kirim_sk->format("d F Y");
                $nestedData['tgl_aktivasi'] = $skstg->tgl_aktivasi->format("d F Y");
                $nestedData['dokumen'] =
                '<a href="'.asset('storage/uploads').'/'.$skstg->filename_dokumen_sk.'" class="btn btn-sm btn-info">
                    <i class="fa fa-download"></i> Download SK
                </a>';

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
