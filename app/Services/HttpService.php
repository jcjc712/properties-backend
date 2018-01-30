<?php
namespace App\Services;
use GuzzleHttp\Client;
/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 12/26/17
 * Time: 22:31
 */
class HttpService
{
    public function get($domain, $uri, $params){
        // The region you are interested in
        $endpoint = $domain;
        $uri = $uri;
        $params = $params;
        // Sort the parameters by key
        ksort($params);
        $pairs = array();
        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }
        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);
        // Generate the signed URL
        $request_url = $endpoint.$uri.'?'.$canonical_query_string;
        /*Make request*/
        $client = new Client();
        $response = $client->request('GET', $request_url, [
            //'headers' => ['Accept' => 'application/json'],
            'timeout' => 120
        ])->getBody()->getContents();
        return json_decode($response);
    }
}