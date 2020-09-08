<?php



namespace App\Http\Controllers;



class GetMojangServiceStatusController
{

    public static function MCStatus(){
        $ch = curl_init('https://status.mojang.com/check');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $results = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($results, true);
        foreach($json as $address)
        {
            $server = array_keys($address)[0];
            $colour = array_values($address)[0];
            $dotcolor = array_values($address)[0];
            switch($colour)
            {
                case 'green':
                    $colour = 'lightgreen';
                    $dotcolor = 'dotgreen';
                    break;
                case 'red':
                    $dotcolor = 'dotred';
                    break; //Do nothing, red is good
                case 'yellow':
                    $dotcolor = 'dotyellow';
                    break; //Do nothing, yellow is good

                default:
                    $dotcolor = 'dot';
                    $colour = 'red';
                    break; //Something went wrong, assume it's down
            }
            echo "<tr><td><span>$server </span><span class='$dotcolor'></span> <br></td></tr>" . PHP_EOL;
        }

    }
}
