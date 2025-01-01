<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function csv_view() {
        return view('CSV.csv_view');
    }

    public function create_csv(Request $request){
        die($request);
        return response()->json(['data' => view('CSV.csv_result' , ['result' => $request->all()])->render()]);
    }
}
