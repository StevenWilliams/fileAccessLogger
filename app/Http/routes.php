<?php
use \App\FileAccess;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$app->get('/', function () use ($app) {
    return $app->welcome();
});

$app->get('file/{file}', function ($file) use ($app) {
    $filesan = str_replace('/', '-', $file);
    $filesan = str_replace("\\", '-', $filesan);


    $access = new FileAccess;
    $access->ip = Request::getClientIp();
    $access->file = $file;
    $access->save();

   // return Response::make(file_get_contents(base_))
    return response()->download(base_path('resources/files/' . $filesan));
});

