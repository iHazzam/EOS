<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use Illuminate\Http\Request;
use Mpociot\BotMan\BotMan;

class BotmanController extends Controller
{


    public function handle()
    {
        dd('made it here');
        $botman = app('botman');
        $botman->verifyServices('harry_messenger_botman_webhook');

        // Simple respond method
        $botman->hears('Hello', function (BotMan $bot) {
            $bot->reply('Hi there :)');
        });

        $botman->listen();
    }
    public function privacy()
    {
        return view('privacy');
    }
    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }

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
