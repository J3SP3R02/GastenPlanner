<?php

namespace App\Http\Controllers;

use App\Models\bolCredentials;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CadeautipsController extends Controller
{
    public function index () {
        return view('cadeaus.index');
    }

    public function getAccessToken(Request $request) {

        //Get linux time and created_at from database
        $expireIn = DB::table('bol_credentials')->value('expire_date');
        $createdAt = DB::table('bol_credentials')->value('created_at');

        $currentTimestamp = Carbon::now()->timestamp;

        //Set the Created_at timestamp to linux timestamp
        $createdAtLinux = strtotime($createdAt);

        //If the current linux time is higher (passed the allowed time) a new token will be requested
        if ($currentTimestamp > ($createdAtLinux + $expireIn)) {

            //Delete expired row
            DB::table('bol_credentials')->delete();

            //Api credentials
            //TODO: put in .env file
            $tokenUrl = 'https://login.bol.com/token';
            $clientId = '7a7be2f1-90b6-4599-b749-c3a5a30b4712';
            $clientSecret = 'CRC(V57KP6SLUkLJoKjRRzdRiBNOOo5PVXTdylbhOs8U9!xLxfVc(mAQQvSjzd5b';

            $client = new Client();

            //Basic authorization request
            $res = $client->request('POST', $tokenUrl, [
                'auth' => [$clientId, $clientSecret],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            $responseData = $res->getBody()->getContents();

            $decodedResponse = json_decode($responseData, true);

            //Create new row with the latest token
            bolCredentials::create([
                'access_token' => $decodedResponse['access_token'],
                'token_type' => $decodedResponse['token_type'],
                'expire_date' => $decodedResponse['expires_in'],
                'scope' => $decodedResponse['scope'],
            ]);

            return back();

        } else {

            //User search input
            $input = $request->input('query');

            //Api credentials from database
            $url = 'https://api.bol.com/catalog/v4/search/';
            $apiToken = bolCredentials::first()->access_token;
            $bearer = bolCredentials::first()->token_type;

            $client = new Client();

            //Api search requests, return array of products
            $res = $client->request('GET', $url, [
                'query' => [
                    'q' => $input
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $bearer.' '.$apiToken,
                ]
            ]);

            $products = json_decode($res->getBody(), true);

            return back();
        }
    }
}
