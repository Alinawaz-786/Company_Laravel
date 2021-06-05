<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use Twilio\Rest\Client;


class ChatBotController extends Controller
{
    //
    public function listenToReplies(Request $request)
    {
//        dd('1211212');
//        $from = $request->input('From');
//        $body = $request->input('Body');
        $from = '03346146615';
        $body = 'this is test';

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', "https://api.github.com/users/$body");
            $githubResponse = json_decode($response->getBody());
            if ($response->getStatusCode() == 200) {
                $message = "*Name:* $githubResponse->name\n";
                $message .= "*Bio:* $githubResponse->bio\n";
                $message .= "*Lives in:* $githubResponse->location\n";
                $message .= "*Number of Repos:* $githubResponse->public_repos\n";
                $message .= "*Followers:* $githubResponse->followers devs\n";
                $message .= "*Following:* $githubResponse->following devs\n";
                $message .= "*URL:* $githubResponse->html_url\n";
                $this->sendWhatsAppMessage($message, $from);
            } else {
                $this->sendWhatsAppMessage($githubResponse->message, $from);
            }
        } catch (RequestException $th) {
            $response = json_decode($th->getResponse()->getBody());
            $this->sendWhatsAppMessage($response->message, $from);
        }
        return;
    }

    /**
     * Sends a WhatsApp message  to user using
     * @param string $message Body of sms
     * @param string $recipient Number of recipient
     */
    public function sendWhatsAppMessage(string $message, string $recipient)
    {
//        $recipient = '+92376203909';
//        $recipient = '+92346146615';
//        $message = 'Hellow';
//
//        $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
//        $account_sid = getenv("TWILIO_SID");
//        $auth_token = getenv("TWILIO_AUTH_TOKEN");
//        $client = new Client($account_sid, $auth_token);

//        return $client->messages->create($recipient, array('from' => "whatsapp:$twilio_whatsapp_number", 'body' => $message));


        $sid    = "AC4fab61a42aa1ad354838e664d88c6ef7";
        $token  = "84d0c43c3f68e6228a62c92a881890e0";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create("whatsapp:+923376203909", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "wafa Nawaz"
                )
            );

        print($message->sid);
    }
}
