<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotmanController extends Controller
{
    public function webhook()
    {
        $access_token = "";
        $verify_token = "harry_messenger_playdale_webhook";
        $hub_verify_token = null;

        if(isset($_REQUEST['hub_challenge'])) {
            $challenge = $_REQUEST['hub_challenge'];
            $hub_verify_token = $_REQUEST['hub_verify_token'];
        }


        if ($hub_verify_token === $verify_token) {
            echo $challenge;
        }
    }
}
