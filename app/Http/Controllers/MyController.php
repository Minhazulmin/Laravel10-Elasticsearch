<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\Client;

class MyController extends Controller
{
    protected $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Data show function
     *
     * @param Request $request
     * @return void
     */
    public function indexData(Request $request)
    {
        # get request form form
        $query = $request->input('query');

        # get data by using indexing
        // $params = [
        //     // 'index' => 'bd',
        //     'body' => [
        //         'query' => [
        //             'match' => [
        //                 'name' => $query,
        //             ],
        //         ],
        //     ],
        // ];

        # get data withour indexing
        $params = [
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => [
                            'name',
                            'phone',
                            'email'
                        ],
                    ],
                ],
            ],
        ];

        # Send request to elastic database to get data
        $response = $this->elasticsearch->search($params);
        $data =  $response->getBody();

        return view('search-result',compact('data'));
    }

    /**
     * Store data on elasticsearch
     *
     * @param Request $request
     * @return void
     */
    public function addData(Request $request){
        try {
            $params = [
                'index' => 'adventure',
                'body' => $request->all(),
            ];

            $response = $this->elasticsearch->index($params);
            return $response;
        } catch (Throwable $th) {
            throw $th;
        }

    }

}
