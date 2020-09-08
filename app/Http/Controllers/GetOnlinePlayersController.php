<?php


namespace App\Http\Controllers;


use Throwable;

class GetOnlinePlayersController
{
    public static function GetOnlinePlayers($ip, $port = 25749) {
        /*
            GetOnlinePlayers PHP function by Mario Latif.
                Usage:
                    GetOnlinePlayers(SERVER_IP, SERVER_PORT[optional])
        */

        // Create a CURL connection to the API.
        $ch = curl_init('https://mcapi.us/server/status?ip='.$ip.'&port='.$port);

        if (!$ch) {
            return 0;
        }
        if (!curl_setopt($ch, CURLOPT_RETURNTRANSFER, true)) {
            return 0;
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!curl_exec($ch)) {
            return 0;
        }
        $results = curl_exec($ch);


        curl_close($ch);

        // Unserialize the JSON output
        $json = json_decode($results, true);

        // Return the online players
        $onlineplayers = $json['players']['now'];
        return $onlineplayers;
    }
}
