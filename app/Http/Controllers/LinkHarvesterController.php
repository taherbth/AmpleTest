<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BaseDomain;
use App\Models\DomainUrl;
use App\Jobs\ProcessDomainUrls;

class LinkHarvesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('domain.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Make the inputs as a single entries by new line
        $domain_names = preg_split('/\r\n|\r|\n/', $request->domain_name);
        // Dispatch the job to process the data
        ProcessDomainUrls::dispatch($domain_names);        
    }  

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
