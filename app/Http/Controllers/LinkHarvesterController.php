<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BaseDomain;
use App\Models\DomainUrl;
use App\Jobs\ProcessDomainUrls;
use Yajra\DataTables\DataTables;


class LinkHarvesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        try{            
            return view('domain.index'); // Create this view
        }catch(Exception $error){
            dd('Error:'.$error->getMessage());
        }
    }
    public function getDomainUrls(Request $request){
        // $all_domains =  BaseDomain::where('user_id', auth()->user()->id)->with('domianUrls')->get();
        
        /* if ($request->ajax()) {
            return DataTables::of($all_domains)
                ->addColumn('domianUrls', function ($post) {
                    return $all_domains->domianUrls->pluck('id')->implode('<br>');
                })
                ->rawColumns(['domianUrls'])
                ->toJson();  
        } */

        if ($request->ajax()) {
            $domains = BaseDomain::with(['domianUrls' => function($query) {
                $query->orderBy('base_domain_id', 'ASC');
            }])
            ->orderBy('id', 'ASC') // Order the main domains by ID
            ->get();

            $data = $domains->map(function ($domain) {
                return [
                    'id' => $domain->id,
                    'domain_name' => $domain->domain_name,
                    'urls' => $domain->domianUrls->pluck('domain_url_name')->implode('<br>')
                ];
            });
            return DataTables::of($data)
                ->rawColumns(['urls'])
                ->make(true);
        }
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
        try{
            ProcessDomainUrls::dispatch($domain_names, auth()->user()->id);               
            return redirect()->action([LinkHarvesterController::class, 'index']);
        }catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
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
