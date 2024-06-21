## Following the instruction you can run Laravel-Elasticsearch in your local machine

![Sponsor](https://i.postimg.cc/QdPWVf9Y/Screenshot-1.png) </br> 
**For Sponsor WhatsApp me +8801751337061**</br>
Watch video on YouTube: https://www.youtube.com/minit61 </br>
Watch video on Facebook: https://www.facebook.com/minit61</br>

### Setup local enviroment 🙂 <br />

**[Step - 1]** **Create laravel new project:**
```bash
composer create-project laravel/laravel example-app
```
Or
```bash
laravel new example-app
```
**[Step - 2]** **Then install elasticsearch on your project through the command:**
(Go to your project, open on code editor and open project terminal)
 ```bash
composer require elasticsearch/elasticsearch
```
```bash
composer require symfony/psr-http-message-bridge
```
**[Step - 3]** **Download the file for local enviroment setup:** 
https://www.elastic.co/downloads/past-releases#enterprise-search
- Note: I installed  7.17.0

- After downloading this file go to bin folder and run (elasticsearch.bat)
- Please hit the url http://localhost:9200/
And get result like this -
- **Output:**
<pre>
    {
  "name" : "BD-036",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "OrfvV2cORsSFghcKm8Yb3Q",
  "version" : {
    "number" : "7.17.0",
    "build_flavor" : "default",
    "build_type" : "zip",
    "build_hash" : "bee86328705acaa9a6daede7140defd4d9ec56bd",
    "build_date" : "2022-01-28T08:36:04.875279988Z",
    "build_snapshot" : false,
    "lucene_version" : "8.11.1",
    "minimum_wire_compatibility_version" : "6.8.0",
    "minimum_index_compatibility_version" : "6.0.0-beta1"
  },
  "tagline" : "You Know, for Search"
}
</pre>

**[Step - 4]** **Push code on .env file:**   
```bash
ELASTICSEARCH_HOST=localhost
ELASTICSEARCH_PORT=9200
```
**[Step - 5]** **Add service provider to use this command your project:**
```bash
php artisan make:provider ElasticsearchServiceProvider
```
**[Step - 6]** **Code push on service provider that we created:**
<pre>
Use under namespace:

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Client;
</pre>

Note: Push code on register() function
<pre>
 $this->app->singleton(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(['localhost:9200'])->build();
    });
</pre>
**[Step - 7]** **Register on Config/App.php**
	
Put on the  providers :
```bash
App\Providers\ElasticsearchServiceProvider::class,
```
**[Step - 8]** **Add code in Config/Database.php**
```bash
	'elasticsearch' => [
    'driver' => 'elasticsearch',
    'hosts' => [
        [
            'host' => env('ELASTICSEARCH_HOST', 'localhost'),
            'port' => env('ELASTICSEARCH_PORT', 9200),
            'scheme' => env('ELASTICSEARCH_SCHEME', 'http'),
            'user' => env('ELASTICSEARCH_USER', ''),
            'pass' => env('ELASTICSEARCH_PASS', ''),
        ],
    ],
],
```

**[Step - 9]** **Create Controller**
```bash 
	php artisan make:controller MyController
```
**[Step - 10]** **Add Route on routes/web.php**
```bash
Route::view('/', 'welcome');
Route::post('/store',[MyController::class,'addData'])->name('store.data');
Route::view('/search','search');
Route::get('/search-data',[MyController::class,'indexData'])->name('search.data');
```
Put code on the top
```bash
use App\Http\Controllers\MyController;
```
**[Step - 11]** **Add page on views folder**<br/>
	**welcome.blade.php**<br/>
	**search.blade.php**<br/>
	**search-result.blade.php**<br/>

- welcome.blade.php
```bash
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="mt-5 card p-5">
            <form method="post" action="{{route('store.data')}}">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control"  name="name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control"  name="email">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control"  name="phone">
                </div>
                <button type="submit" class="btn btn-info mt-2">Submit</button>
            </form>
        </div>
 </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
```
- search.blade.php

```bash
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
  <body>
    <div class="container">
        <div class="mt-5 card p-5">
            <form method="get" action="{{route('search.data')}}">
                <div class="form-group" style="width: 80%;float: left;">
                    <label for="">Searh Data</label>
                    <input type="search" class="form-control"  name="query" >
                </div>
                <button type="submit" class="btn btn-info mt-2" style="margin-bottom: -47px;margin-left: 8px;width: 15%;">Submit</button>
            </form>
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
```

- search-result.blade.php

```bash
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
  <body>
    <div class="container">
        <div class="mt-5 card p-5">
           {{$data??''}}
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
```
**[Step - 12]** **Add code on MyController Use after namespace**
```bash 
use Elastic\Elasticsearch\Client;
```
**[Step - 13]** **Add code on MyController constructor function**

 ```bash
protected $elasticsearch;
    	public function __construct(Client $elasticsearch)
   	 {
       		$this->elasticsearch = $elasticsearch;
    	}

```
**[Step - 14]** **Add code on MyController indexData Function**
```bash

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
```
**[Step - 15]** **Add code on MyController addData function**
```bash 
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
```
**[Step - 16]** **run the command on the project terminal**
```bash 
	php artisan serve
```
Hit the url
```bash
	http://127.0.0.1:8000/
```
