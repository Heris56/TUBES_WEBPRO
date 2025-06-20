<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DafaController;
use App\Http\Controllers\HaikalController;
use App\Http\Controllers\FersyaController;
use App\Http\Controllers\RaphaelMessageController;
use App\Http\Controllers\DarrylController;
use App\Http\Controllers\MahesaController;
use Illuminate\Support\Facades\Http;


// landing/register
Route::view('/', 'darryl_landing')->name('umkm.landing');
route::post('/daftar', [DarrylController::class, 'daftar'])->name('umkm.daftar');

// lupa password
Route::view('/lupa-password', 'darryl_lupa-password')->name('umkm.lupa-password.form');
route::post('/lupa-password', [DarrylController::class, 'lupaPassword'])->name('umkm.lupa-password');

// reset password
route::post('/reset-password', [DarrylController::class, 'resetPassword'])->name('umkm.reset-password');
Route::view('/reset-password', 'darryl_reset-password')->name('umkm.reset-password.form');

// auth
Route::view('/auth', 'darryl_2fa')->name('umkm.auth');
Route::post('/auth/verifikasi-otp', [DarrylController::class, 'verifikasiOTP'])->name('umkm.verifikasi');
Route::post('/auth/kirim-code', [DarrylController::class, 'kirimCode'])->name('umkm.kirim-code');

// masuk
Route::view('/masuk', 'darryl_masuk')->name('umkm.masuk');
route::post('/login', [DarrylController::class, 'masuk'])->name('umkm.login');
Route::get('/reset-password/{token}', function (string $token) {
    return view('umkm.new-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// logout
Route::post('/logout', [DarrylController::class, 'logout'])->name('umkm.logout');

//Route Punya Dapa
Route::get('/getdashboard', [DafaController::class, 'getdashboard'])->name('umkm.dashboard');
Route::get('/getpesanread', [DafaController::class, 'getpesanread'])->name('umkm.pesanread');
Route::get('/kelolapesanan', [DafaController::class, 'getpesananmasuk'])->name('umkm.kelolapesanan');
Route::get('/pesananditerima', [DafaController::class, 'getpesananditerima'])->name('umkm.pesananditerima');
Route::get('/pesananditolak', [DafaController::class, 'getpesananditolak'])->name('umkm.pesananditolak');
Route::get('/pesananselesai', [DafaController::class, 'getpesananselesai'])->name('umkm.pesananselesai');
Route::put('/updatestatuspesananditerima/{id_batch}', [DafaController::class,
'updatestatuspesananditerima'])->name('umkm.updatestatuspesananditerima');
Route::put('/updatestatuspesananditolak/{id_batch}', [DafaController::class, 'updatestatuspesananditolak'])->name('umkm.updatestatuspesananditolak');
Route::get('/getprofileumkm', [DafaController::class, 'getprofileumkm'])->name('umkm.getprofileumkm');
Route::put('/editprofileumkm', [DafaController::class, 'editprofileumkm'])->name('umkm.editprofileumkm');
Route::put('/terimakurir/{id_kurir}', [DafaController::class, 'terimakurir'])->name('umkm.terimakurir');
Route::put('/tolakKurir/{id_kurir}', [DafaController::class, 'tolakKurir'])->name('umkm.tolakKurir');
Route::get('/getumkmkurir', [DafaController::class, 'getumkmkurir'])->name('umkm.getumkmkurir');
Route::put('/pecatKurir/{id_kurir}', [DafaController::class, 'pecatKurir'])->name('umkm.pecatKurir');
Route::put('/deletekurir/{id_kurir}', [DafaController::class, 'deleteKurir'])->name('umkm.deletekurir');
Route::get('/konfirmasiKurir', [DafaController::class, 'getdatakurir'])->name('umkm.konfirmasiKurir');
Route::get('/historyKurirUmkm', [DafaController::class, 'gethistorykurirumkm'])->name('umkm.gethistorykurirumkm');
Route::get('/logout-timeout', function () {
    session()->flush();
    return redirect('/masuk?session=timeout')->with('timeout', true);
});
//End Route Punya Dapa

Route::view('/sidebar', 'Dafa_Sidebar')->name('umkm.sidebar');

Route::view('/inbox_penjual_prioritas', 'fersya_inbox_penjual_prioritas')->name('umkm.inbox_penjual_prioritas');
route::get('/inbox', [FersyaController::class, 'getviewinbox'])->name('umkm.inbox');
Route::get('/campaign/{id}', [FersyaController::class, 'getCampaign'])->name('umkm.getcampaign');
Route::put('/editcampaign/{id}', [FersyaController::class, 'editCampaign'])->name('umkm.editcampaign');
Route::post('/addcampaign', [FersyaController::class, 'addCampaign'])->name('umkm.addcampaign');;
Route::view('/tambahcampaign', 'fersya_campaignTambah')->name('umkm.tambahcampaign');
Route::get('/pesanan-masuk', [FersyaController::class, 'getviewinboxmasuk'])->name('pesanan.masuk');
Route::get('/pesanan-diterima', [FersyaController::class, 'getviewinboxditerima'])->name('pesanan.diterima');
// Route::delete('/campaign/{id}', [FersyaController::class, 'deleteCampaign'])->name('umkm.deletecampaign');
// Route::get('/campaign/{id}'  , [FersyaController::class, 'getUpdateCampaignView'])->name('umkm.updatecampaign');


route::get('/managebarang', [HaikalController::class, 'getviewproduk'])->name('umkm.managebarang');
route::post('/managebarang', [HaikalController::class, 'addproduk'])->name('umkm.addbarang');
route::get('/updatebarang/{id}', [HaikalController::class, 'getUpdateprodukview'])->name('umkm.viewupdate');
route::put('/updateproduk/{id}', [HaikalController::class, 'editproduk'])->name('umkm.updateproduk');
route::delete('/deleteproduk/{id}', [HaikalController::class, 'deleteProduk'])->name('umkm.deletebarang');
Route::get('/tambahbarang', [HaikalController::class, 'getviewtambahproduk'])->name('umkm.tambahbarang');
route::get('/produk/{id}', [HaikalController::class, 'getmodal'])->name('umkm.getprodukbyID');
Route::get('/searchproduk', [HaikalController::class, 'searchproduk'])->name('umkm.search');
Route::get('/proxy/produk', function () {
    $response = Http::withOptions(['verify' => false])->get('https://umkmapi-production.up.railway.app/produk');
    return response($response->body(), $response->status())
        ->header('Content-Type', $response->header('Content-Type')[0]);
});

Route::view('/statistik_penjualan', 'Mahesa_Statistik_Penjualan')->name('umkm.statistik');
// Add these routes for daily and yearly stats
Route::get('/daily-stats/{umkmId}', [MahesaController::class, 'getDailyStats'])->name('umkm.dailyStats');
Route::get('/monthly-stats/{umkmId}', [MahesaController::class, 'getYearlyStats'])->name('umkm.yearlyStats');

// // View routes (removed since they don't need dynamic data passing)
Route::view('/messages', 'Raphael_message_penjual')->name('message');
Route::get('/message', [RaphaelMessageController::class, 'showmsgPage'])->name('umkm.message');


// Chat routes for dynamic content
Route::get('/umkm/message/{id}', [RaphaelMessageController::class, 'showChatPage'])->name('messagepage');
Route::post('/send-message/{id}', [RaphaelMessageController::class, 'sendMessage'])->name('sendMessage');
Route::get('/msgumkm', [RaphaelMessageController::class, 'getmessageumkm'])->name('msgumkm');

// Routing untuk pesan yang sudah dibaca dan belum dibaca
Route::get('/umkm/messages/inbox', [RaphaelMessageController::class, 'showinbox'])->name('umkm.messages.inbox');
Route::get('/umkm/messages/read', [RaphaelMessageController::class, 'showReadMessages'])->name('umkm.messages.read');
Route::get('/umkm/messages/unread', [RaphaelMessageController::class, 'showUnreadMessages'])->name('umkm.messages.unread');
Route::put('/message/read/', [RaphaelMessageController::class, 'markMessageAsRead'])->name('message.read');
Route::get('/messages/{umkmId}/{pembeliId}', [RaphaelMessageController::class, 'getMessagesFromNode']);
