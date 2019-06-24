<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewKP;
use SmsGateway;
use Datatables;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dtSebelumTempo($hari)
    {
      $datas = ViewKP::belum($hari);
      return Datatables::of($datas)
      ->editColumn('tgl_perpanjangan', function ($data) {
				return date("d-m-Y", strtotime( $data->tgl_perpanjangan ));
			})
      ->make(true);
    }

    public function dtLewatTempo()
    {
      $datas = ViewKP::lewat();
      return Datatables::of($datas)
      ->editColumn('tgl_perpanjangan', function ($data) {
				return date("d-m-Y", strtotime( $data->tgl_perpanjangan ));
			})
      ->make(true);
    }

    public function smsKPSebelum(Request $request)
    {
      $device = (int)config('services.smsgateway.device_id');
      $data = $request->kp;
      foreach ($data as $k => $v) {
        array_forget($data[$k], ['no_kp', 'nolambung', 'no_kendaraan', 'pemilik', 'mperusahaan_id', 'nama_perusahaan', 'tgl_perpanjangan', 'sisa']);
        $data[$k] = array_add($data[$k], 'device_id', $device);
      }

      $sms = $this->sendsms($data);

      return response()->json($sms);
    }

    public function smsKPLewat(Request $request)
    {
      $device = (int)config('services.smsgateway.device_id');
      $data = $request->kp;
      foreach ($data as $k => $v) {
        array_forget($data[$k], ['no_kp', 'nolambung', 'no_kendaraan', 'pemilik', 'mperusahaan_id', 'nama_perusahaan', 'tgl_perpanjangan', 'sisa']);
        $data[$k] = array_add($data[$k], 'device', $device);
      }
      
      $sms = $this->sendsms($data);

      return response()->json($sms);
    }

    private function sendsms($data)
    {
      $curl = curl_init();

      curl_setopt_array($curl, array(
          CURLOPT_URL => "https://smsgateway.me/api/v4/message/send",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUyNjIzODE2NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjUxODIzLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.jA-HzktnaVSB1EUAjaz8Ez-Q4Yl2NIt56Wb1C3FmTWI",
            "accept: application/json",
            "accept-language: en-US,en;q=0.8",
            "content-type: application/json",
          ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
          return "cURL Error #:" . $err;
      } else {
          return $response;
      }
    }
}
