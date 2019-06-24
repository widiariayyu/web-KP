<?php

namespace App\Http\Controllers\ASK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ASK\KPSK;
use App\Txkp;
use App\Txkpdetil;
use App\Msetting;
use App\Mstatusawalkendaraan;
use Auth;
use DB;
use Datatables;

class KPSKController extends Controller
{
    private $kpsk;

    public function __construct(KPSK $kpsk)
    {
        $this->kpsk = $kpsk;
    }

    public function index()
    {
        return view('ASK.KP.SK.index');
    }

    public function dt()
    {
        return Datatables::of($this->kpsk->dt())
            ->addColumn('action', function ($data) {
                return '
            <a href="' . route('ask.kpsk.kp.index', ['id' => $data->id]) . '" class="btn btn-xs btn-success">
                <i class="glyphicon glyphicon-edit"></i> Detil
            </a>
            ';
            })
            ->make(true);
    }

    public function create()
    {
        return view('ASK.KP.SK.create');
    }

    public function store(Request $request)
    {
        try {
            $request->merge([
                'TglPermohonan' => date('Y-m-d', strtotime($request->TglPermohonan)),
                'TglPelaksanaan' => date('Y-m-d', strtotime($request->TglPelaksanaan)),
                'TglPenyelenggaraan' => date('Y-m-d', strtotime($request->TglPenyelenggaraan))
            ]);
            $data = $this->kpsk->tambah($request->all());
            return redirect()->action('ASK\KPSKController@index')
                ->with('alert-success', 'Data SK Berhasil Ditambah');
        } catch (\Exception $e) {
            return redirect()->action('ASK\KPSKController@index')
                ->with('alert-danger', 'Data SK Gagal Ditambah');
        }
    }

    public function kp(KPSK $sk)
    {
        $setting = Msetting::first();
        $sa = Mstatusawalkendaraan::all();
        return view('ASK.KP.SK.KP.index', compact('sk', 'setting', 'sa'));
    }

    public function dtKP($sk)
    {
        $id = str_replace("_", "/", $sk);
        $skp = KPSK::where('id', $id)->orWhere('SKPenyelenggaraan', $id)->first();
        $datas = Txkp::where('no_sk_gub', $skp ? $skp->SKPenyelenggaraan : $id)->with('statusawalkendaraan');
        return Datatables::of($datas)
            ->addColumn('pilih', function ($data) {
                return '
            <a href="' . route('kp.ask.edit', ['id' => $data->kode]) . '" class="btn btn-xs btn-success">
                <i class="glyphicon glyphicon-edit"></i> Pilih
            </a>
            ';
            })->rawColumns(['pilih'])
            ->make(true);
    }

    public function kpStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $setting = Msetting::first();
            $biaya = $setting->biaya;
            for ($i = 1; $i <= 4; $i++) {
                $tgl[$i] = date("Y-m-d", strtotime($request->tglsk . " +" . $i . " year"));
            }
            $master = Txkp::create([
                'kode' => 'ASK-' . $request->perusahaan . '-' . $request->nolambung,
                'nolambung' => $request->nolambung,
                'no_sk_gub' => $request->nosk,
                'tgl_sk_gub' => $request->tglsk,
                'tgl_akhir' => $tgl[4],
                'mstatusawalkendaraan_id' => $request->sak,
                'mperusahaan_id' => $request->perusahaan,
                'no_kendaraan' => $request->nokendaraan,
                'no_kp' => $setting->nomor_surat_kp_1 . '.' . $request->NoInduk . '/' . $request->nolambung . '/ASK.' . $request->perusahaan . '/DMPTSP-' . $request->tahun,
                'tgl1' => $request->tglsk,
                'tgl2' => $tgl[1],
                'tgl3' => $tgl[2],
                'tgl4' => $tgl[3],
                'tgl5' => $tgl[4]
            ]);

            Txkpdetil::create([
                'kode_kp' => $master->kode,
                'perpanjangan_ke' => 1,
                'tgl_perpanjangan' => $request->tglsk,
                'user_id' => Auth::id(),
                'bayar' => $biaya,
                'tgl_bayar' => $request->tglsk
            ]);

            for ($i = 1; $i <= 4; $i++) {
                Txkpdetil::create([
                    'kode_kp' => $master->kode,
                    'perpanjangan_ke' => $i + 1,
                    'user_id' => Auth::id(),
                    'tgl_perpanjangan' => $tgl[$i]
                ]);
            }
            DB::commit();
            return redirect()->action('ASK\KPSKController@kp', ['sk' => $request->idsk])
                ->with('alert-success', 'Data KP Berhasil Ditambah');
        } catch (Exception $e) {
            dd($e);
            return redirect()->action('ASK\KPSKController@kp', ['sk' => $request->idsk])
                ->with('alert-danger', 'Data KP Gagal Ditambah');
        }
    }
}
