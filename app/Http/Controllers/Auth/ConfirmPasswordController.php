<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Konfirmasi Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller bertanggung jawab untuk menangani konfirmasi password dan
    | menggunakan sifat sederhana untuk memasukkan perilaku.
    */

    use ConfirmsPasswords;

    /**
     * Mengarahkan pengguna ketika URL gagal.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Membuat sebuah instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
