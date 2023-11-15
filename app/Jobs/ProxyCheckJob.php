<?php

namespace App\Jobs;

use App\Enums\ProxyTypesEnum;
use App\Services\HttpClientService;
use App\Services\ProxyCheckServiceInterface;
use GuzzleHttp\Promise\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProxyCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $proxiesArr;

    protected string $key;

    /**
     * Create a new job instance.
     */
    public function __construct(array $proxiesArr, string $key)
    {
        $this->proxiesArr = $proxiesArr;
        $this->key = $key;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $httpClient = new HttpClientService();
        $proxyTypes = ProxyTypesEnum::toArray();
        $promises = [];
        $timing = [];
        foreach ($proxyTypes as $type) {
            foreach ($this->proxiesArr as $proxy) {
                $httpClient->addRequestToPromises($proxy, $type, $promises, $timing);
            }
        }
        $results = Utils::all($promises)->wait();
        app(ProxyCheckServiceInterface::class)->createProxyResultsFromResponses($results, $timing, $this->key);
    }
}
