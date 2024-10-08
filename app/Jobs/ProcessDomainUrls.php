<?php
namespace App\Jobs;
use App\Models\BaseDomain;
use App\Models\DomainUrl;
use App\Jobs\ProcessDomainUrls;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use DB;

class ProcessDomainUrls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $domain_names;
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @param array $domain_names
     * @return void
     */
    public function __construct($domain_names, $userId)
    {
        $this->domain_names = $domain_names;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        Log::info('Testing the sites...');
        // Normalize newlines and split into lines
        $lines = preg_split('/\r\n|\r|\n/', $this->domain_names, -1, PREG_SPLIT_NO_EMPTY);

        // Log the content of $lines for debugging
        Log::info('Lines After Splitting:', ['lines' => $lines]);

        // Ensure $lines is an array
        if (!is_array($lines)) {
            Log::error('Error: $lines is not an array.', ['lines' => $lines]);
            return; // or throw an exception if needed
        }

        // Prepare data for insertion
        $data = array_map(fn($line) => ['domain_name' => $this->getBaseDomain(trim($line)), 'user_id' => $this->userId], $lines);

        // Log the prepared data
        Log::info('Prepared Data for Insert:', ['data' => $data]);
        

        DB::transaction(function () use ($data) {
            BaseDomain::insert($data);
        });


        // $domain_created = BaseDomain::firstOrCreate($data);
        // Store each entry as a separate record in the database
        // if(!empty($this->domain_names)){
        //     foreach ($this->domain_names as $each_domain) {              
        //         if (!empty($each_domain)) {
        //             $base_domain =  $this->getBaseDomain($each_domain); 
        //             // Check if the base-domain already exists
        //             $domain_created = BaseDomain::firstOrCreate(['domain_name' => $base_domain, 'user_id' => $this->userId]);
        //             // Check if the domain-url already exists
        //             $domain_url_created = DomainUrl::firstOrCreate(['domain_url_name' => $each_domain, 'base_domain_id' => $domain_created->id]);
        //         }
        //         // Log success or failure
        //         if ($domain_created) {
        //             Log::info('Data saved successfully for user ID: ', ['user_id' => $this->userId]);
        //             // event(new DataProcessedSuccessfully($this->userId));
        //         } else {
        //             Log::error('Failed to save data for user ID: ', ['user_id' => $this->userId]);
        //         }
        //     }
        // }        
    }
    function getBaseDomain($url) {
        // Parse the URL and get the host part
        $parsedUrl = parse_url($url);

        if (!isset($parsedUrl['host'])) {
            return null; // Invalid URL or no host found
        }
        // Split the host into parts
        $hostParts = explode('.', $parsedUrl['host']);
        
        // Return the base domain
        // For example: https://stackoverflow.com/questions, https://x.com/taher_abu/communities_web
        if (count($hostParts) > 2) {
            $domainParts = array_slice($hostParts, -2); // Get the last two parts
            return implode('.', $domainParts);
        }

        // If it's already a simple domain, return as is
        return $parsedUrl['host'];
    }
}
