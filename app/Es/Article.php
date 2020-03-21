<?php
/**
 * Created by PhpStorm.
 * User: zven
 * Date: 2020-02-26
 * Time: 23:39
 * Description：Article.php
 */

namespace App\Es;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Str;
use Faker\Generator as faker;

class Article
{
    private $client = null;
    private $hosts = ['127.0.0.1'];
    private $index = 'testb';
    private $type = 'blog';

    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
    }

    public function get()
    {
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => 6,
        ];
        $data = $this->client->get($params);
        dump($data);
    }

    public function createIndex()
    {

        $params = [
            'index' => $this->index
        ];
        $this->client->indices()->delete($params);

        $params = [
            'index' => $this->index,
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0,
                    'analysis' => [
                        'analyzer' => [
                            'title_ana' => [
                                'type' => 'standard'
                            ]
                        ]
                    ]
                ],
                'mappings' => [
                    'blog' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            'title' => [
                                'type' => 'string',
                                'analyzer' => 'title_ana'
                            ],
                            'content' => [
                                'type' => 'string'
                            ],
                            'tags' => [
                                'type' => 'nested',
                                'properties' => [
                                    'tag_name' => [
                                        'type' => 'keyword'
                                    ],
                                    'tag_id' => [
                                        'type' => 'integer'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->client->indices()->create($params);

        //$this->store();
        print_r($response);
    }

    public function store()
    {
        $faker = app(faker::class);
        $params = [
            'index' => $this->index,
            'type'  => $this->type,
            'id'    => rand(1,220),
            'body'  => [
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'tags' => [
                    ['tag_name'=>'hello', 'tag_id'=>6],
                    ['tag_name'=>$faker->word, 'tag_id'=>3],
                ]
            ]
        ];
        $this->client->create($params);
    }
}
