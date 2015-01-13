<?php
namespace App\Helpers;

use Crypt;
use GuzzleHttp as GuzzleHttp;
use GuzzleHttp\Client as Client;
use GuzzleHttp\Exception\ClientException as ClientException;
use GuzzleHttp\Exception\ServerException as ServerException;
use Config;
use App;

class ClientHelper
{
    public static function getData($requestpath, $bool = false)
    {   
        $client = new Client();
        $response = $client->get(Config::get('app.apibaseurl') . $requestpath, 'headers' => ['Accept' => 'application/json']);
        return $response->json(['object' => $bool]);
    }

    public static function postData($requestpath, $bool = false)
    {
        $client = new Client();
        $response = $client->post(Config::get('app.apibaseurl') . $requestpath, 'headers' => ['Accept' => 'application/json']);
        return $response->json(['object' => $bool]);
    }

    public static function putData($requestpath, $bool = false)
    {
        $client = new Client();
        $response = $client->put(Config::get('app.apibaseurl') . $requestpath, 'headers' => ['Accept' => 'application/json']);
        return $response->json(['object' => $bool]);
    }

    public static function deleteData($requestpath, $bool = false)
    {
        $client = new Client();
        $response = $client->delete(Config::get('app.apibaseurl') . $requestpath, 'headers' => ['Accept' => 'application/json']);
        return $response->json(['object' => $bool]);
    }
}
