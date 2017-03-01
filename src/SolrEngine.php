<?php

namespace ScoutEngines\Solr;

use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;
use Elasticsearch\Client as Elastic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;
use Solarium\Client as SolrClient;
use Illuminate\Database\Eloquent\Model;

class SolrEngine extends Engine
{
    /**
     * @var \Solarium\Client
     */
    protected $solr;

    /**
     * SolrEngine constructor.
     * @param \Solarium\Client $solr
     */
    public function __construct(SolrClient $solr)
    {
        $this->solr = $solr;
    }

    /**
     * Update the given model in the index.
     *
     * @param  Collection  $models
     * @return void
     */
    public function update($models)
    {

        $docs = [];
        $update = $this->solr->createUpdate();

        $models->each(function ($model) use ($update, &$docs) {
            $doc = $update->createDocument();
            $doc->id = $model->getKey();
            $doc->name = $model->name;
            $docs[] = $doc;
        });
        $update->addDocuments($docs);
        $update->addCommit();
        $this->solr->update($update);



//        $models->each(function($model) use (&$params)
//        {
//            $params['body'][] = [
//                'update' => [
//                    '_id' => $model->getKey(),
//                    '_index' => $this->index,
//                    '_type' => $model->searchableAs(),
//                ]
//            ];
//            $params['body'][] = [
//                'doc' => $model->toSearchableArray(),
//                'doc_as_upsert' => true
//            ];
//        });
//
//        $this->elastic->bulk($params);
    }

    /**
     * Remove the given model from the index.
     *
     * @param  Collection  $models
     * @return void
     */
    public function delete($models)
    {
        dd($models);
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  Builder  $builder
     * @return mixed
     */
    public function search(Builder $builder)
    {
//        return $this->performSearch($builder, array_filter([
//            'numericFilters' => $this->filters($builder),
//            'size' => $builder->limit,
//        ]));
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  Builder  $builder
     * @param  int  $perPage
     * @param  int  $page
     * @return mixed
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
//        $result = $this->performSearch($builder, [
//            'numericFilters' => $this->filters($builder),
//            'from' => (($page * $perPage) - $perPage),
//            'size' => $perPage,
//        ]);
//
//        $result['nbPages'] = $result['hits']['total']/$perPage;
//
//        return $result;
    }
    /**
     * Map the given results to instances of the given model.
     *
     * @param  mixed  $results
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return Collection
     */
    public function map($results, $model)
    {
//        if (count($results['hits']['total']) === 0) {
//            return Collection::make();
//        }
//
//        $keys = collect($results['hits']['hits'])
//            ->pluck('_id')->values()->all();
//
//        $models = $model->whereIn(
//            $model->getKeyName(), $keys
//        )->get()->keyBy($model->getKeyName());
//
//        return collect($results['hits']['hits'])->map(function ($hit) use ($model, $models) {
//            return $models[$hit['_id']];
//        });
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param  mixed  $results
     * @return \Illuminate\Support\Collection
     */
    public function mapIds($results)
    {
//        return collect($results['hits']['hits'])->pluck('_id')->values();
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param  mixed  $results
     * @return int
     */
    public function getTotalCount($results)
    {
//        return $results['hits']['total'];
    }

//
//    /**
//     * Perform the given search on the engine.
//     *
//     * @param  Builder  $builder
//     * @param  array  $options
//     * @return mixed
//     */
//    protected function performSearch(Builder $builder, array $options = [])
//    {
//        $params = [
//            'index' => $this->index,
//            'type' => $builder->model->searchableAs(),
//            'body' => [
//                'query' => [
//                    'bool' => [
//                        'must' => [['query_string' => [ 'query' => "*{$builder->query}*"]]]
//                    ]
//                ]
//            ]
//        ];
//
//        if (isset($options['from'])) {
//            $params['body']['from'] = $options['from'];
//        }
//
//        if (isset($options['size'])) {
//            $params['body']['size'] = $options['size'];
//        }
//
//        if (isset($options['numericFilters']) && count($options['numericFilters'])) {
//            $params['body']['query']['bool']['must'] = array_merge($params['body']['query']['bool']['must'],
//                $options['numericFilters']);
//        }
//
//        return $this->elastic->search($params);
//    }
//
//    /**
//     * Get the filter array for the query.
//     *
//     * @param  Builder  $builder
//     * @return array
//     */
//    protected function filters(Builder $builder)
//    {
//        return collect($builder->wheres)->map(function ($value, $key) {
//            return ['match_phrase' => [$key => $value]];
//        })->values()->all();
//    }
}
