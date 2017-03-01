<?php
namespace ScoutEngines\Solr;

use Laravel\Scout\EngineManager;
use Illuminate\Support\ServiceProvider;
use Solarium\Client as SolrClient;

class SolrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        resolve(EngineManager::class)->extend('solr', function () {
            return new SolrEngine(new SolrClient(config('scout.solr')));
        });
    }
}
