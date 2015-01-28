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
    public static function getData($requestpath, $bool = false) {
        try {
            $client = new Client();
            $response = $client->get(Config::get('app.apibaseurl') . $requestpath, ['headers' => ['Accept' => 'application/json']]);
            return $response->json(['object' => $bool]);
        }
        catch(DecryptException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 400,
                'code' => 'ticketcenter40001',
                'devmessage' => 'Invalid data trying to get decrypted.',
                'result' => null
            );
        }
        catch(ServerException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 403,
                'code' => 'api40302',
                'devmessage' => 'Unauthorized access.',
                'result' => null
            );
        }
        catch(ClientException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 404,
                'code' => 'api40401',
                'devmessage' => 'Endpoint not found.',
                'result' => null
            );
        }
        catch(RuntimeException $ex) {
            return array(
                'href' => $requestpath,
                'status' => $ex->getCode() ,
                'code' => 'ticketcenter40099',
                'devmessage' => 'Runtime exception error: ' . $ex->getMessage() ,
                'result' => null
            );
        }
    }
    
    public static function postData($requestpath, $bool = false) {
        try {
            $client = new Client();
            $response = $client->post(Config::get('app.apibaseurl') . $requestpath, ['headers' => ['Accept' => 'application/json']]);
            return $response->json(['object' => $bool]);
        }
        catch(DecryptException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 400,
                'code' => 'ticketcenter40001',
                'devmessage' => 'Invalid data trying to get decrypted.',
                'result' => null
            );
        }
        catch(ServerException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 403,
                'code' => 'api40302',
                'devmessage' => 'Unauthorized access.',
                'result' => null
            );
        }
        catch(ClientException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 404,
                'code' => 'api40401',
                'devmessage' => 'Endpoint not found.',
                'result' => null
            );
        }
        catch(RuntimeException $ex) {
            return array(
                'href' => $requestpath,
                'status' => $ex->getCode() ,
                'code' => 'ticketcenter40099',
                'devmessage' => 'Runtime exception error: ' . $ex->getMessage() ,
                'result' => null
            );
        }
    }
    
    public static function putData($requestpath, $bool = false) {
        try {
            
            $client = new Client();
            $response = $client->put(Config::get('app.apibaseurl') . $requestpath, ['headers' => ['Accept' => 'application/json']]);
            return $response->json(['object' => $bool]);
        }
        catch(DecryptException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 400,
                'code' => 'ticketcenter40001',
                'devmessage' => 'Invalid data trying to get decrypted.',
                'result' => null
            );
        }
        catch(ServerException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 403,
                'code' => 'api40302',
                'devmessage' => 'Unauthorized access.',
                'result' => null
            );
        }
        catch(ClientException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 404,
                'code' => 'api40401',
                'devmessage' => 'Endpoint not found.',
                'result' => null
            );
        }
        catch(RuntimeException $ex) {
            return array(
                'href' => $requestpath,
                'status' => $ex->getCode() ,
                'code' => 'ticketcenter40099',
                'devmessage' => 'Runtime exception error: ' . $ex->getMessage() ,
                'result' => null
            );
        }
    }
    
    public static function deleteData($requestpath, $bool = false) {
        try {
            $client = new Client();
            $response = $client->delete(Config::get('app.apibaseurl') . $requestpath, ['headers' => ['Accept' => 'application/json']]);
            return $response->json(['object' => $bool]);
        }
        catch(DecryptException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 400,
                'code' => 'ticketcenter40001',
                'devmessage' => 'Invalid data trying to get decrypted.',
                'result' => null
            );
        }
        catch(ServerException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 403,
                'code' => 'api40302',
                'devmessage' => 'Unauthorized access.',
                'result' => null
            );
        }
        catch(ClientException $ex) {
            return array(
                'href' => $requestpath,
                'status' => 404,
                'code' => 'api40401',
                'devmessage' => 'Endpoint not found.',
                'result' => null
            );
        }
        catch(RuntimeException $ex) {
            return array(
                'href' => $requestpath,
                'status' => $ex->getCode() ,
                'code' => 'ticketcenter40099',
                'devmessage' => 'Runtime exception error: ' . $ex->getMessage() ,
                'result' => null
            );
        }
    }
}
