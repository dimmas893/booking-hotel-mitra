<?php

use App\Models\Mitra;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $mitra = Mitra::get();
    return view('welcome', compact('mitra'));
})->name('welcome');
Route::get('/login/view', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//admin
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::post('/autocomplete-search-query', [App\Http\Controllers\DashboardController::class, 'show_data'])->name('autocomplete.search.query');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::post('/admin/store', [App\Http\Controllers\AdminController::class, 'store'])->name('admin-store');
Route::get('/admin/all', [App\Http\Controllers\AdminController::class, 'all'])->name('admin-all');
Route::get('/admin/edit', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin-edit');
Route::post('/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin-update');
Route::post('/admin/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin-delete');

//jenis mitra
Route::get('/jenismitra', [App\Http\Controllers\JenisMitraController::class, 'index'])->name('jenismitra');
Route::post('/jenismitra/store', [App\Http\Controllers\JenisMitraController::class, 'store'])->name('jenismitra-store');
Route::get('/jenismitra/all', [App\Http\Controllers\JenisMitraController::class, 'all'])->name('jenismitra-all');
Route::get('/jenismitra/edit', [App\Http\Controllers\JenisMitraController::class, 'edit'])->name('jenismitra-edit');
Route::post('/jenismitra/update', [App\Http\Controllers\JenisMitraController::class, 'update'])->name('jenismitra-update');
Route::post('/jenismitra/delete', [App\Http\Controllers\JenisMitraController::class, 'delete'])->name('jenismitra-delete');


Route::get('/jadwalfasilitaskolam/{idfasilitas}', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'index'])->name('jadwalfasilitaskolam');
Route::get('/jadwalfasilitaskolam/mitra/{idfasilitas}', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'indexmitra'])->name('jadwalfasilitaskolammitra');
Route::get('/jadwalfasilitaskolam/all/mitra/{idfasilitas}', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'allmitra'])->name('jadwalfasilitaskolam-allmitra');
Route::get('/jadwalfasilitaskolam/{idfasilitas}/riwayat', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'indexriwayat'])->name('jadwalfasilitaskolam-riwayat');
Route::post('/jadwalfasilitaskolam/store', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'store'])->name('jadwalfasilitaskolam-store');
Route::get('/jadwalfasilitaskolam/riwayat/{idfasilitas}', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'allriwayat'])->name('jadwalfasilitaskolam-all-riwayat');
Route::get('/jadwalfasilitaskolam/all/{idfasilitas}', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'all'])->name('jadwalfasilitaskolam-all');
// Route::get('/jadwalfasilitaskolam/edit', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'testing'])->name('editkolam');
Route::get('/jadwalfasilitaskolam/dimmas', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'dimmas'])->name('dimmas');
Route::post('/jadwalfasilitaskolam/update', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'update'])->name('jadwalfasilitaskolam-update');
Route::post('/jadwalfasilitaskolam/delete', [App\Http\Controllers\jadwalfasilitaskolamController::class, 'delete'])->name('jadwalfasilitaskolam-delete');

Route::get('/mitra', [App\Http\Controllers\MitraController::class, 'index'])->name('mitra');
Route::get('/mitra/profil', [App\Http\Controllers\MitraController::class, 'indexmitra'])->name('mitramitra');
Route::post('/mitra/store', [App\Http\Controllers\MitraController::class, 'store'])->name('mitra-store');
Route::get('/mitra/all', [App\Http\Controllers\MitraController::class, 'all'])->name('mitra-all');
Route::get('/mitra/all/profl', [App\Http\Controllers\MitraController::class, 'allmitra'])->name('mitra-allmitra');
Route::get('/mitra/edit', [App\Http\Controllers\MitraController::class, 'edit'])->name('mitra-edit');
Route::post('/mitra/update', [App\Http\Controllers\MitraController::class, 'update'])->name('mitra-update');
Route::post('/mitra/delete', [App\Http\Controllers\MitraController::class, 'delete'])->name('mitra-delete');

Route::get('/perjanjianmitra/{id}', [App\Http\Controllers\PerjanjianMitraController::class, 'index'])->name('perjanjianmitra');
Route::get('/perjanjianmitra/view/{id}', [App\Http\Controllers\PerjanjianMitraController::class, 'indexmitra'])->name('perjanjianmitramitra');
Route::post('/perjanjianmitra/store', [App\Http\Controllers\PerjanjianMitraController::class, 'store'])->name('perjanjianmitra-store');
Route::get('/perjanjianmitra/all/{id}', [App\Http\Controllers\PerjanjianMitraController::class, 'all'])->name('perjanjianmitra-all');
Route::get('/perjanjianmitra/all/view/{id}', [App\Http\Controllers\PerjanjianMitraController::class, 'allmitra'])->name('perjanjianmitra-allmitra');
Route::get('/mitra/perjanjianmitra', [App\Http\Controllers\MitraController::class, 'perjanjianmitra'])->name('mitra-perjanjianmitra');
Route::get('/mitra/hargasepakatmitra', [App\Http\Controllers\MitraController::class, 'hargasepakatmitra'])->name('hargasepakatmitra-edit');
Route::post('/perjanjianmitra/update', [App\Http\Controllers\PerjanjianMitraController::class, 'update'])->name('perjanjianmitra-update');
Route::post('/perjanjianmitra/delete', [App\Http\Controllers\PerjanjianMitraController::class, 'delete'])->name('perjanjianmitra-delete');

Route::get('/hargasepakatmitra/{idperjanjianmitra}', [App\Http\Controllers\HargaSepakatMitraController::class, 'index'])->name('hargasepakatmitra');
Route::post('/hargasepakatmitra/store', [App\Http\Controllers\HargaSepakatMitraController::class, 'store'])->name('hargasepakatmitra-store');
Route::get('/hargasepakatmitra/all/{idperjanjianmitra}', [App\Http\Controllers\HargaSepakatMitraController::class, 'all'])->name('hargasepakatmitra-all');
// Route::get('/hargasepakatmitra/edit', [App\Http\Controllers\HargaSepakatMitraController::class, 'edit'])->name('hargasepakatmitra-edit');
Route::post('/hargasepakatmitra/update', [App\Http\Controllers\HargaSepakatMitraController::class, 'update'])->name('hargasepakatmitra-update');
Route::post('/hargasepakatmitra/delete', [App\Http\Controllers\HargaSepakatMitraController::class, 'delete'])->name('hargasepakatmitra-delete');


Route::get('/unitsewafasilitas', [App\Http\Controllers\UnitSewaFasilitasController::class, 'index'])->name('unitsewafasilitas');
Route::post('/unitsewafasilitas/store', [App\Http\Controllers\UnitSewaFasilitasController::class, 'store'])->name('unitsewafasilitas-store');
Route::get('/unitsewafasilitas/all', [App\Http\Controllers\UnitSewaFasilitasController::class, 'all'])->name('unitsewafasilitas-all');
Route::get('/unitsewafasilitas/edit', [App\Http\Controllers\UnitSewaFasilitasController::class, 'edit'])->name('unitsewafasilitas-edit');
Route::post('/unitsewafasilitas/update', [App\Http\Controllers\UnitSewaFasilitasController::class, 'update'])->name('unitsewafasilitas-update');
Route::post('/unitsewafasilitas/delete', [App\Http\Controllers\UnitSewaFasilitasController::class, 'delete'])->name('unitsewafasilitas-delete');


Route::get('/rekeningowner', [App\Http\Controllers\RekeningOwnerController::class, 'index'])->name('rekeningowner');
Route::post('/rekeningowner/store', [App\Http\Controllers\RekeningOwnerController::class, 'store'])->name('rekeningowner-store');
Route::get('/rekeningowner/all', [App\Http\Controllers\RekeningOwnerController::class, 'all'])->name('rekeningowner-all');
Route::get('/rekeningowner/edit', [App\Http\Controllers\RekeningOwnerController::class, 'edit'])->name('rekeningowner-edit');
Route::post('/rekeningowner/update', [App\Http\Controllers\RekeningOwnerController::class, 'update'])->name('rekeningowner-update');
Route::post('/rekeningowner/delete', [App\Http\Controllers\RekeningOwnerController::class, 'delete'])->name('rekeningowner-delete');

Route::get('/jenisfasilitas', [App\Http\Controllers\JenisFasilitasController::class, 'index'])->name('jenisfasilitas');
Route::post('/jenisfasilitas/store', [App\Http\Controllers\JenisFasilitasController::class, 'store'])->name('jenisfasilitas-store');
Route::get('/jenisfasilitas/all', [App\Http\Controllers\JenisFasilitasController::class, 'all'])->name('jenisfasilitas-all');
Route::get('/jenisfasilitas/edit', [App\Http\Controllers\JenisFasilitasController::class, 'edit'])->name('jenisfasilitas-edit');
Route::post('/jenisfasilitas/update', [App\Http\Controllers\JenisFasilitasController::class, 'update'])->name('jenisfasilitas-update');
Route::post('/jenisfasilitas/delete', [App\Http\Controllers\JenisFasilitasController::class, 'delete'])->name('jenisfasilitas-delete');


Route::get('/fasilitas', [App\Http\Controllers\FasilitasController::class, 'index'])->name('fasilitas');
Route::post('/fasilitas/store', [App\Http\Controllers\FasilitasController::class, 'store'])->name('fasilitas-store');
Route::get('/fasilitas/all', [App\Http\Controllers\FasilitasController::class, 'all'])->name('fasilitas-all');
Route::get('/fasilitas/edit', [App\Http\Controllers\FasilitasController::class, 'edit'])->name('fasilitas-edit-ajax');
Route::post('/fasilitas/update', [App\Http\Controllers\FasilitasController::class, 'update'])->name('fasilitas-update');
Route::post('/fasilitas/delete', [App\Http\Controllers\FasilitasController::class, 'delete'])->name('fasilitas-delete');

Route::get('/pendapatanmitra/{dimitra}', [App\Http\Controllers\PendapatanMitraController::class, 'index'])->name('pendapatanmitra');
Route::post('/pendapatanmitra/store', [App\Http\Controllers\PendapatanMitraController::class, 'store'])->name('pendapatanmitra-store');
Route::get('/pendapatanmitra/all/{idmitra}', [App\Http\Controllers\PendapatanMitraController::class, 'all'])->name('pendapatanmitra-all');
Route::get('/admin/editpedsdw', [App\Http\Controllers\AdminController::class, 'editpendapatan'])->name('pendapatanmitra-edit');
Route::post('/pendapatanmitra/update', [App\Http\Controllers\PendapatanMitraController::class, 'update'])->name('pendapatanmitra-update');
Route::post('/pendapatanmitra/delete', [App\Http\Controllers\PendapatanMitraController::class, 'delete'])->name('pendapatanmitra-delete');

Route::get('/sop/{idfasilmitra}', [App\Http\Controllers\SOPController::class, 'index'])->name('sop');
Route::get('/sop/mitra/{idfasilmitra}', [App\Http\Controllers\SOPController::class, 'indexmitra'])->name('sopmitra');
Route::get('/sop/all/mitra/{idfasilmitra}', [App\Http\Controllers\SOPController::class, 'allmitra'])->name('sop-allmitra');
Route::get('/sop/riwayat/{idfasilmitra}', [App\Http\Controllers\SOPController::class, 'indexriwayat'])->name('sop-riwayat');
Route::get('/sop/riwayat/all/{idfasilmitra}', [App\Http\Controllers\SOPController::class, 'allriwayat'])->name('sop-all-riwayat');
Route::post('/sop/store', [App\Http\Controllers\SOPController::class, 'store'])->name('sop-store');
Route::get('/sop/edit/sop', [App\Http\Controllers\FasilitasController::class, 'editsop'])->name('sop-edit');
Route::get('/sop/all/{idfasilmitra}', [App\Http\Controllers\SOPController::class, 'all'])->name('sop-all');
Route::post('/sop/update', [App\Http\Controllers\SOPController::class, 'update'])->name('sop-update');
Route::post('/sop/delete', [App\Http\Controllers\SOPController::class, 'delete'])->name('sop-delete');

//tempat nitip edit
Route::get('/fasilitas-mitra/{idperjanjian}', [App\Http\Controllers\FasilitasMitraController::class, 'index'])->name('fasilitas-mitra');
Route::get('/fasilitas-mitra/view/{idperjanjian}', [App\Http\Controllers\FasilitasMitraController::class, 'indexmitra'])->name('fasilitas-mitramitra');
Route::post('/fasilitas-mitra/store', [App\Http\Controllers\FasilitasMitraController::class, 'store'])->name('fasilitas-mitra-store');
Route::get('/fasilitas-mitra/all/{idperjanjian}', [App\Http\Controllers\FasilitasMitraController::class, 'all'])->name('fasilitas-mitra-all');
Route::get('/fasilitas-mitra/all/view/{idperjanjian}', [App\Http\Controllers\FasilitasMitraController::class, 'allmitra'])->name('fasilitas-mitra-allmitra');
Route::get('/fasilitas/edit', [App\Http\Controllers\FasilitasController::class, 'editfasilitas'])->name('fasilitas-mitra-edit');
Route::get('/fasilitas/edit/kolam', [App\Http\Controllers\FasilitasController::class, 'editkolam'])->name('editkolam');
Route::post('/fasilitas-mitra/update', [App\Http\Controllers\FasilitasMitraController::class, 'update'])->name('fasilitas-mitra-update');
Route::post('/fasilitas-mitra/delete', [App\Http\Controllers\FasilitasMitraController::class, 'delete'])->name('fasilitas-mitra-delete');


Route::get('/fasilitas-mitra/{idperjanjian}/riwayat', [App\Http\Controllers\FasilitasMitraController::class, 'indexriwayat'])->name('fasilitas-mitra-riwayat');
Route::get('/fasilitas-mitra/all/{idperjanjian}/riwayat', [App\Http\Controllers\FasilitasMitraController::class, 'allriwayat'])->name('fasilitas-mitra-all-riwayat');
Route::get('/fasilitas-kolam-renang/{idfasilitasmitra}/riwayat', [App\Http\Controllers\FasilitasKolangRenangController::class, 'indexriwayat'])->name('fasilitas-kolam-renang-riwayat');
Route::get('/fasilitas-kolam-renang/all/{idfasilitasmitra}/riwayat', [App\Http\Controllers\FasilitasKolangRenangController::class, 'allriwayat'])->name('fasilitas-kolam-renang-all-riwayat');


Route::get('/fasilitas-kolam-renang/{fasilitaskolamrenangid}', [App\Http\Controllers\FasilitasKolangRenangController::class, 'index'])->name('fasilitas-kolam-renang');
Route::get('/fasilitas-kolam-renang/mitra/{fasilitaskolamrenangid}', [App\Http\Controllers\FasilitasKolangRenangController::class, 'indexmitra'])->name('fasilitas-kolam-renangmitra');
Route::get('/fasilitas-kolam-renang/all/mitra/{fasilitaskolamrenangid}', [App\Http\Controllers\FasilitasKolangRenangController::class, 'allmitra'])->name('fasilitas-kolam-renang-allmitra');
Route::post('/fasilitas-kolam-renang/store', [App\Http\Controllers\FasilitasKolangRenangController::class, 'store'])->name('fasilitas-kolam-renang-store');
Route::get('/fasilitas-kolam-renang/all/{fasilitaskolamrenangid}', [App\Http\Controllers\FasilitasKolangRenangController::class, 'all'])->name('fasilitas-kolam-renang-all');
Route::get('/fasilitas-kolam-renang/all/ajax/{fasilitaskolamrenangid}', [App\Http\Controllers\FasilitasKolangRenangController::class, 'ajax'])->name('ajaxhargakesepakatan');
Route::get('/fasilitas-kolam-renang/edit', [App\Http\Controllers\FasilitasKolangRenangController::class, 'edit'])->name('fasilitas-kolam-renang-edit');
Route::post('/fasilitas-kolam-renang/update', [App\Http\Controllers\FasilitasKolangRenangController::class, 'update'])->name('fasilitas-kolam-renang-update');
Route::post('/fasilitas-kolam-renang/delete', [App\Http\Controllers\FasilitasKolangRenangController::class, 'delete'])->name('fasilitas-kolam-renang-delete');

Route::get('/register/customor', [App\Http\Controllers\CustomorController::class, 'register'])->name('registercustomor');
Route::post('/register/customor/simpan', [App\Http\Controllers\CustomorController::class, 'registersimpan'])->name('registercustomorsimpan');
Route::post('/login/aplikasi', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('loginaplikasi');
Route::post('/logout/aplikasi', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logoutaplikasi');


Route::get('/detail/mitra/{idmitra}', [App\Http\Controllers\DetailMitraController::class, 'detail'])->name('detailmitra');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/detail/pembayaran', [App\Http\Controllers\DetailMitraController::class, 'pembayaran'])->name('pembayaranview');
        Route::post('/detail/pembayaran/store', [App\Http\Controllers\DetailMitraController::class, 'store'])->name('pembayaranviewstore');
        Route::get('/detail/pembayaran/{reference}', [App\Http\Controllers\DetailMitraController::class, 'reference'])->name('detail.silahkanbayar');
    }
);

Route::get('/cek-pesanan-ajax', [App\Http\Controllers\DetailMitraController::class, 'cekpesanan'])->name('cekpesanan');
Route::get('/cek-pesanan', [App\Http\Controllers\DetailMitraController::class, 'cekpesananview'])->name('cekpesananview');
Route::get('/cek-pesanan-ajax-mitra', [App\Http\Controllers\DetailMitraController::class, 'cekpesananmitra'])->name('cekpesananmitra');
Route::get('/cek-pesanan-mitra', [App\Http\Controllers\DetailMitraController::class, 'cekpesananviewmitra'])->name('cekpesananviewmitra');
Route::get('/cek-pesanan-detail/{reference}', [App\Http\Controllers\DetailMitraController::class, 'cekpesananviewdetail'])->name('cekpesananviewdetail');

Route::get('/cek-pesanan-detail/mitra/{reference}', [App\Http\Controllers\DetailMitraController::class, 'cekpesananviewdetailmitra'])->name('cekpesananviewdetailmitra');



Route::get('/login/mitra', [App\Http\Controllers\Auth\LoginMitraController::class, 'view'])->name('loginaplikasimitraview');
Route::post('/login/aplikasi/mitra', [App\Http\Controllers\Auth\LoginMitraController::class, 'login'])->name('loginaplikasimitra');
Route::get('/login/admin', [App\Http\Controllers\Auth\LoginMitraController::class, 'viewadmin'])->name('loginaplikasimitraviewadmin');
Route::post('/login/aplikasi/admin', [App\Http\Controllers\Auth\LoginMitraController::class, 'loginadmin'])->name('loginaplikasimitraadmin');
Route::post('/logout/aplikasi/mitra', [App\Http\Controllers\Auth\LoginMitraController::class, 'logout'])->name('logoutaplikasimitra');


Route::get('/pendapatanmitra/me/cash', [App\Http\Controllers\PendapatanMitraController::class, 'pendapatan'])->name('mitrapendapatan');
Route::get('/pendapatanmitra/me/all', [App\Http\Controllers\PendapatanMitraController::class, 'pendapatanall'])->name('mitrapendapatanall');

Route::get('/pesanan/admin', [App\Http\Controllers\PesananAdminController::class, 'pesananadmin'])->name('pesananadmin');
Route::get('/pembayaran-via-admin/{order_no}', [App\Http\Controllers\PesananAdminController::class, 'pembayaranadmin'])->name('pembayaranadmin');
Route::get('/pesanan/admin/ajax', [App\Http\Controllers\PesananAdminController::class, 'pesananadminajax'])->name('pesananadminajax');
require __DIR__ . '/auth.php';
