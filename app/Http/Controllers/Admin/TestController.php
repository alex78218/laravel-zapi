<?php

namespace App\Http\Controllers\Admin;

use App\Es\Article as EsArticle;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index(Request $request)
    {
        echo config('app.url');
        echo env('APP_URL');

        //echo 111;die();
        //$es = new EsArticle();
        //$es->get();
        //$es->createIndex();
        //$es->store();
    }


}