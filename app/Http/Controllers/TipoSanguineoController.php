<?php

namespace App\Http\Controllers;

use App\TipoSanguineo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Illuminate\Http\UploadedFile;
use Reader;

class TipoSanguineoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tipoSanguineo = TipoSanguineo::All();
        return view('tiposanguineo.listar', ['data' => $tipoSanguineo]);
    }
}
