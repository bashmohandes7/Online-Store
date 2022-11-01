<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function create()
    {
        return view('dashboard.products.import');
    } // end of create

    public function import(Request $request)
    {
        // get the job and assign it count
        $job = new ImportProducts($request->post('count'));
        // assign the job to the queue
        $job->onQueue('import')->onConnection('database');
        // dispatch the job
        $this->dispatch($job);
        session()->flash('success', 'importing products ...');
        return to_route('dashboard.products.index');
    } // end of import
}
