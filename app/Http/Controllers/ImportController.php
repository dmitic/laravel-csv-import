<?php

namespace App\Http\Controllers;

use App\Imports\CategoryImport;
use App\Imports\DeparmentImport;
use App\Imports\ManufacturerImport;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;


class ImportController extends Controller
{
    public function create(){
        return view('import-form');
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Excel::import(new CategoryImport, $request->file);
                Excel::import(new DeparmentImport, $request->file);
                Excel::import(new ManufacturerImport, $request->file);
                Excel::import(new ProductsImport, $request->file);
            });
        } catch(NoTypeDetectedException $e) {
            return redirect()->back()->with('message', 'Wrong file type, it should be CSV file.');
        } catch(\Exception $e) {
            return redirect()->back()->with('message', 'There was an error, please try again! ' . $e->getMessage());
        }

        return redirect()->back()->with('message', 'Records are imported successfully!');
    }
}
