<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
  Route::get('/', function () { return redirect()->route('home'); });
  
  Route::prefix('home')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/sms/kp/sebelum', 'HomeController@smsKPSebelum')->name('sms.kp.sebelum');
    Route::post('/sms/kp/lewat', 'HomeController@smsKPLewat')->name('sms.kp.lewat');
		Route::prefix('dt')->group(function () {
      Route::get('/sebelum/{hari}', 'HomeController@dtSebelumTempo')->name('home.dt.kp.belum');
      Route::get('/lewat', 'HomeController@dtLewatTempo')->name('home.dt.kp.lewat');
    });
	});
	// Route::get('/rbac/permission', 'rbacPermissionController@index')->name('permission');
	// Route::get('/rbac/permission/getdata', 'rbacPermissionController@getdata')->name('permission.get');
	Route::get('/rbac/permission/s', 'rbacPermissionController@seldata')->name('permission.select');

	Route::prefix('api')->group(function () {
    	Route::post('/m/perusahaan', 'mPerusahaanController@apistore')->name('api.perusahaan.store');
    	Route::post('/m/perusahaantaksi', 'TaksiPerusahaanController@apistore')->name('api.taksi.perusahaan.store');
		Route::post('/m/jk', 'mJenisKendaraanController@apistore')->name('api.jk.store');
		Route::post('/m/merk', 'mMerkController@apistore')->name('api.merk.store');
		Route::post('/m/warna', 'mWarnaController@apistore')->name('api.warna.store');
	});

	Route::get('/rbac/role', 'rbacRoleController@index')->name('role');
	Route::get('/rbac/role/getdata', 'rbacRoleController@getdata')->name('role.get');
	Route::post('/rbac/role', 'rbacRoleController@store')->name('role.store');
	Route::put('/rbac/role/{id}', 'rbacRoleController@update')->name('role.update');
	Route::post('/rbac/role/v', 'rbacRoleController@validasi')->name('role.validasi');
	Route::get('/rbac/role/s', 'rbacRoleController@seldata')->name('role.select');

	Route::get('/rbac/user', 'rbacUserController@index')->name('user');
	Route::get('/rbac/user/getdata', 'rbacUserController@getdata')->name('user.get');
	Route::post('/rbac/user', 'rbacUserController@store')->name('user.store');
	Route::put('/rbac/user/{id}', 'rbacUserController@update')->name('user.update');
	Route::post('/rbac/user/reset', 'rbacUserController@reset')->name('user.reset');
	Route::post('/rbac/user/v', 'rbacUserController@validasi')->name('user.validasi');

	Route::get('/m/merk', 'mMerkController@index')->name('merk');
	Route::get('/m/merk/getdata', 'mMerkController@getdata')->name('merk.get');
	Route::post('/m/merk', 'mMerkController@store')->name('merk.store');
	Route::put('/m/merk/{id}', 'mMerkController@update')->name('merk.update');
	Route::get('/m/merk/v', 'mMerkController@validasi')->name('merk.validasi');

	Route::get('/m/merk/select', 'mMerkController@seldata')->name('merk.select');

	Route::get('/m/warna', 'mWarnaController@index')->name('warna');
	Route::get('/m/warna/getdata', 'mWarnaController@getdata')->name('warna.get');
	Route::post('/m/warna', 'mWarnaController@store')->name('warna.store');
	Route::put('/m/warna/{id}', 'mWarnaController@update')->name('warna.update');
	Route::post('/m/warna/v', 'mWarnaController@validasi')->name('warna.validasi');

	Route::get('/m/warna/select', 'mWarnaController@seldata')->name('warna.select');

	Route::get('/m/jk', 'mJenisKendaraanController@index')->name('jk');
	Route::get('/m/jk/getdata', 'mJenisKendaraanController@getdata')->name('jk.get');
	Route::post('/m/jk', 'mJenisKendaraanController@store')->name('jk.store');
	Route::put('/m/jk/{id}', 'mJenisKendaraanController@update')->name('jk.update');
	Route::post('/m/jk/v', 'mJenisKendaraanController@validasi')->name('jk.validasi');

	Route::get('/m/jk/select', 'mJenisKendaraanController@seldata')->name('jk.select');

	Route::get('/m/perusahaan', 'mPerusahaanController@index')->name('perusahaan');
	Route::get('/m/perusahaan/getdata', 'mPerusahaanController@getdata')->name('perusahaan.get');
	Route::post('/m/perusahaan', 'mPerusahaanController@store')->name('perusahaan.store');
	Route::put('/m/perusahaan/{id}', 'mPerusahaanController@update')->name('perusahaan.update');
	Route::post('/m/perusahaan/v', 'mPerusahaanController@validasi')->name('perusahaan.validasi');

	Route::get('/m/perusahaan/select', 'mPerusahaanController@seldata')->name('perusahaan.select');
  Route::get('/m/perusahaan/select/{id}', 'mPerusahaanController@selper')->name('perusahaan.selper');
  
	Route::get('/m/perusahaantaksi', 'TaksiPerusahaanController@index')->name('taksi.perusahaan');
	Route::get('/m/perusahaantaksi/getdata', 'TaksiPerusahaanController@getdata')->name('taksi.perusahaan.get');
	Route::post('/m/perusahaantaksi', 'TaksiPerusahaanController@store')->name('taksi.perusahaan.store');
	Route::put('/m/perusahaantaksi/{id}', 'TaksiPerusahaanController@update')->name('taksi.perusahaan.update');
	Route::post('/m/perusahaantaksi/v', 'TaksiPerusahaanController@validasi')->name('taksi.perusahaan.validasi');

	Route::get('/m/perusahaantaksi/select', 'TaksiPerusahaanController@seldata')->name('taksi.perusahaan.select');
	Route::get('/m/perusahaantaksi/select/{id}', 'TaksiPerusahaanController@selper')->name('taksi.perusahaan.selper');

	Route::get('/m/sak', 'mStatusAwalKendaraanController@index')->name('sak');
	Route::get('/m/sak/getdata', 'mStatusAwalKendaraanController@getdata')->name('sak.get');
	Route::post('/m/sak', 'mStatusAwalKendaraanController@store')->name('sak.store');
	Route::put('/m/sak/{id}', 'mStatusAwalKendaraanController@update')->name('sak.update');
	Route::post('/m/sak/v', 'mStatusAwalKendaraanController@validasi')->name('sak.validasi');

	Route::get('/m/sak/select', 'mStatusAwalKendaraanController@seldata')->name('sak.select');

	Route::get('/m/wilayah', 'mWilayahController@index')->name('wilayah');
	Route::get('/m/wilayah/getdata', 'mWilayahController@getdata')->name('wilayah.get');
	Route::post('/m/wilayah', 'mWilayahController@store')->name('wilayah.store');
	Route::put('/m/wilayah/{id}', 'mWilayahController@update')->name('wilayah.update');
	Route::post('/m/wilayah/v', 'mWilayahController@validasi')->name('wilayah.validasi');

	Route::get('/m/wilayah/select', 'mWilayahController@seldata')->name('wilayah.select');

	Route::get('/m/katperusahaan', 'mKategoriPerusahaanController@index')->name('katperusahaan');
	Route::get('/m/katperusahaan/getdata', 'mKategoriPerusahaanController@getdata')->name('katperusahaan.get');
	Route::post('/m/katperusahaan', 'mKategoriPerusahaanController@store')->name('katperusahaan.store');
	Route::put('/m/katperusahaan/{id}', 'mKategoriPerusahaanController@update')->name('katperusahaan.update');
	Route::post('/m/katperusahaan/v', 'mKategoriPerusahaanController@validasi')->name('katperusahaan.validasi');

	Route::get('/m/katperusahaan/select', 'mKategoriPerusahaanController@seldata')->name('katperusahaan.select');

	Route::get('/m/setting', 'mSettingController@index')->name('setting');
	Route::get('/m/setting/getdata', 'mSettingController@getdata')->name('setting.get');
	Route::post('/m/setting', 'mSettingController@store')->name('setting.store');
	Route::put('/m/setting/{id}', 'mSettingController@update')->name('setting.update');
	Route::post('/m/setting/v', 'mSettingController@validasi')->name('setting.validasi');

	Route::get('/m/setting/select', 'mSettingController@seldata')->name('setting.select');

	Route::get('/m/pasal', 'mPasalController@index')->name('pasal');
	Route::get('/m/pasal/getdata', 'mPasalController@getdata')->name('pasal.get');
	Route::post('/m/pasal', 'mPasalController@store')->name('pasal.store');
	Route::put('/m/pasal/{id}', 'mPasalController@update')->name('pasal.update');
	Route::post('/m/pasal/v', 'mPasalController@validasi')->name('pasal.validasi');

	Route::get('/m/pasal/select', 'mPasalController@seldata')->name('pasal.select');
	Route::get('/m/pasal/select/{id}', 'mPasalController@selpasal')->name('pasal.selpasal');

	Route::get('/m/jenisangkutan/select', 'mJenisangkutanController@seldata')->name('jenisangkutan.select');

	Route::prefix('perubahansifat')->group(function () {
		Route::get('/', 'PerubahanSifatController@index')->name('perubahansifat');
		Route::get('/getdata', 'PerubahanSifatController@getdata')->name('perubahansifat.get');

		Route::get('/create', 'PerubahanSifatController@create')->name('perubahansifat.create');
		Route::post('/', 'PerubahanSifatController@store')->name('perubahansifat.store');
		Route::post('/api', 'PerubahanSifatController@apiStore')->name('perubahansifat.api.store');

		Route::get('/{id}', 'PerubahanSifatController@edit')->name('perubahansifat.edit');
		Route::put('/api/{id}', 'PerubahanSifatController@apiUpdate')->name('perubahansifat.api.update');
		Route::put('/{id}', 'PerubahanSifatController@update')->name('perubahansifat.update');

		Route::get('/cetak/{id}', 'PerubahanSifatController@cetak')->name('perubahansifat.cetak');
	});

	Route::prefix('kp')->group(function () {
		Route::prefix('ask')->group(function () {
			Route::get('/', 'KartuPengawasanController@index')->name('kp.ask');
			Route::get('/getdata', 'KartuPengawasanController@getdata')->name('kp.ask.get');

			Route::delete('/{id}', 'KartuPengawasanController@delete')->name('kp.ask.delete');

			Route::get('/create', 'KartuPengawasanController@create')->name('kp.ask.create');
			Route::post('/', 'KartuPengawasanController@store')->name('kp.ask.store');
			Route::post('/api', 'KartuPengawasanController@apiStore')->name('kp.ask.api.store');

			Route::get('/{id}', 'KartuPengawasanController@edit')->name('kp.ask.edit');
			Route::put('/{id}', 'KartuPengawasanController@update')->name('kp.ask.update');
			Route::put('/api/{id}', 'KartuPengawasanController@apiUpdate')->name('kp.ask.api.update');

			Route::get('/cetak/{id}', 'KartuPengawasanController@cetak')->name('kp.ask.cetak');
			Route::get('/qr/{id}', 'KartuPengawasanController@qr')->name('kp.ask.qr');
			Route::get('/{perusahaan}/v', 'KartuPengawasanController@validasi')->name('kp.ask.validasi');
			Route::get('/nolambung/{perusahaan}', 'KartuPengawasanController@getNoLambung')->name('kp.ask.getnolambung');
		});

		Route::prefix('taksi')->group(function () {
			Route::get('/', 'KPTaksiController@index')->name('kp.taksi');
			Route::get('/getdata', 'KPTaksiController@getdata')->name('kp.taksi.get');

			Route::delete('/{id}', 'KPTaksiController@delete')->name('kp.taksi.delete');

			Route::get('/create', 'KPTaksiController@create')->name('kp.taksi.create');
			Route::post('/', 'KPTaksiController@store')->name('kp.taksi.store');
			Route::post('/api', 'KPTaksiController@apiStore')->name('kp.taksi.api.store');

			Route::get('/{id}', 'KPTaksiController@edit')->name('kp.taksi.edit');
			Route::put('/{id}', 'KPTaksiController@update')->name('kp.taksi.update');
			Route::put('/api/{id}', 'KPTaksiController@apiUpdate')->name('kp.taksi.api.update');

			Route::get('/cetak/{id}', 'KPTaksiController@cetak')->name('kp.taksi.cetak');
			Route::get('/qr/{id}', 'KPTaksiController@qr')->name('kp.taksi.qr');
			Route::get('/{perusahaan}/v', 'KPTaksiController@validasi')->name('kp.taksi.validasi');
			Route::get('/nolambung/{perusahaan}', 'KPTaksiController@getNoLambung')->name('kp.taksi.getnolambung');
		});
  });

  Route::get('/pribadi/select/{id}', 'PerubahanSifatController@seldata')->name('pribadi.select');
  
  Route::prefix('peremajaan')->group(function () {
		Route::prefix('ask')->group(function () {
			Route::get('/', 'PeremajaanController@index')->name('peremajaan.ask');
			Route::get('/getdata', 'PeremajaanController@getdata')->name('peremajaan.ask.get');

			Route::get('/create', 'PeremajaanController@create')->name('peremajaan.ask.create');
			Route::post('/', 'PeremajaanController@store')->name('peremajaan.ask.store');
			Route::post('/api', 'PeremajaanController@apiStore')->name('peremajaan.ask.api.store');

			Route::get('/edit/{id}', 'PeremajaanController@edit')->name('peremajaan.ask.edit');	
			Route::put('/{id}', 'PeremajaanController@update')->name('peremajaan.ask.update');
			Route::put('/api/{id}', 'PeremajaanController@apiUpdate')->name('peremajaan.ask.api.update');

			Route::get('/cetak/{id}', 'PeremajaanController@cetak')->name('peremajaan.ask.cetak');
			Route::get('/getkp', 'PeremajaanController@getkp')->name('peremajaan.ask.getkp');
		});

		Route::prefix('taksi')->group(function () {
			Route::get('/', 'PeremajaanTaksiController@index')->name('peremajaan.taksi');
			Route::get('/getdata', 'PeremajaanTaksiController@getdata')->name('peremajaan.taksi.get');

			Route::get('/create', 'PeremajaanTaksiController@create')->name('peremajaan.taksi.create');
			Route::post('/', 'PeremajaanTaksiController@store')->name('peremajaan.taksi.store');
			Route::post('/api', 'PeremajaanTaksiController@apiStore')->name('peremajaan.taksi.api.store');

			Route::get('/edit/{id}', 'PeremajaanTaksiController@edit')->name('peremajaan.taksi.edit');
			Route::put('/{id}', 'PeremajaanTaksiController@update')->name('peremajaan.taksi.update');
			Route::put('/api/{id}', 'PeremajaanTaksiController@apiUpdate')->name('peremajaan.taksi.api.update');

			Route::get('/cetak/{id}', 'PeremajaanTaksiController@cetak')->name('peremajaan.taksi.cetak');
			Route::get('/getkp', 'PeremajaanTaksiController@getkp')->name('peremajaan.taksi.getkp');
		});
  });
  
  Route::prefix('perpanjangan')->group(function () {
		Route::prefix('ask')->group(function () {
			Route::get('/', 'PerpanjanganController@index')->name('perpanjangan.ask');
			Route::get('/detail/{id?}', 'PerpanjanganController@detail')->name('perpanjangan.ask.detail');
			Route::get('/getdata/{id}', 'PerpanjanganController@getdata')->name('perpanjangan.ask.getdata');
			Route::get('/bayar/{id}', 'PerpanjanganController@bayar')->name('perpanjangan.ask.bayar');
		});

		Route::prefix('taksi')->group(function () {
			Route::get('/', 'PerpanjanganTaksiController@index')->name('perpanjangan.taksi');
			Route::get('/detail/{id?}', 'PerpanjanganTaksiController@detail')->name('perpanjangan.taksi.detail');
			Route::get('/getdata/{id}', 'PerpanjanganTaksiController@getdata')->name('perpanjangan.taksi.getdata');
			Route::get('/bayar/{id}', 'PerpanjanganTaksiController@bayar')->name('perpanjangan.taksi.bayar');
		});
  });
  
  Route::prefix('laporan')->group(function () {
		Route::prefix('ask')->group(function () {
			Route::get('/', 'LapASKController@index')->name('lap.ask.index');
			Route::post('/semua', 'LapASKController@semua')->name('lap.ask.semua');
			Route::post('/per', 'LapASKController@per')->name('lap.ask.per');
			Route::post('/pendapatan', 'LapASKController@pendapatan')->name('lap.ask.pendapatan');
			Route::post('/rekap', 'LapASKController@rekap')->name('lap.ask.rekap');
		});

		Route::prefix('taksi')->group(function () {
			Route::get('/', 'LapTaksiController@index')->name('lap.taksi.index');
			Route::post('/semua', 'LapTaksiController@semua')->name('lap.taksi.semua');
			Route::post('/per', 'LapTaksiController@per')->name('lap.taksi.per');
			Route::post('/pendapatan', 'LapTaksiController@pendapatan')->name('lap.taksi.pendapatan');
			Route::post('/rekap', 'LapTaksiController@rekap')->name('lap.taksi.rekap');
		});
  });

});
