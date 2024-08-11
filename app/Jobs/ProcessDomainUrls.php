<?php
namespace App\Jobs;
use App\Models\DomainUrl;
use App\Jobs\ProcessDomainUrls;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDomainUrls implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $domain_names;

    /**
     * Create a new job instance.
     *
     * @param array $domain_names
     * @return void
     */
    public function __construct(array $domain_names)
    {
        $this->domain_names = $domain_names;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        // Store each entry as a separate record in the database
        if(!empty($this->domain_names)){
            foreach ($this->domain_names as $each_domain) {              
                if (!empty($each_domain)) {
                    $base_domain =  $this->getBaseDomain($each_domain); 
                    // Check if the base-domain already exists
                    $domain_created = BaseDomain::firstOrCreate(['domain_name' => $base_domain, 'user_id' => auth()->user()->id]);
                    // Check if the domain-url already exists
                    $domain_url_created = DomainUrl::firstOrCreate(['domain_url_name' => $each_domain, 'base_domain_id' => $domain_created->id]);
                }
            }
        }
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
