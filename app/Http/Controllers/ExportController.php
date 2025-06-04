<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\BibliografiaDataTable;

class ExportController extends Controller
{
    public function index(BibliografiaDataTable $datatable){
        return $datatable->render('export');
    }
}
