<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class AdsController extends Controller
{
    public function ads()
    {
        $client = new Client(['verify' => false , 'cookies' => true]);

        $headers = [
            // here we can send headers or cookies
        ];

        $options = [
            'multipart' => [
                // here we can send any post method inputs
                // multipart or formData
            ]
        ];
        $url = 'https://www.dubizzle.com.eg/properties/apartments-duplex-for-sale/?sorting=asc-price';
        $request = new \GuzzleHttp\Psr7\Request('GET' , $url , $headers);
        $res = $client->sendAsync($request,$options)->wait();

        if ($res->getStatusCode() == 200) {
            $dom = new Dom();
            $dom->loadStr($res->getBody()->getContents());
            $data = $dom->find('.a5112ca8');
            foreach ($data as $datum){
                echo $datum->text . '<br>';
            }
//            dd($dom->find('.a5112ca8')[0]);
        }
        return response()->json('ads will be here ');
    }
}
