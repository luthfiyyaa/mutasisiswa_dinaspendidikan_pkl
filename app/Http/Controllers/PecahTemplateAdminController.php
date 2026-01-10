<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Mutasi;


class PecahTemplateAdminController extends Controller
{
  public function index()
  {

    $mutasi_masuk = Mutasi::where('mutasi_jenis', '=', '1')->count();
    $mutasi_keluar = Mutasi::where('mutasi_jenis', '=', '2')->count();
    return view('admin.index', compact('mutasi_masuk','mutasi_keluar'));

  }
}
