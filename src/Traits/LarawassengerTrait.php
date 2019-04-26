<?php

namespace Uzzaircode\Larawassenger\Traits;

trait LarawassengerTrait{


    public $device_id;

    public $priority;

    public function __construct()
    {

        $this->device_id = config('wassenger.device_id');

        $this->priority = 'normal';

    }

    public function curlSetup($curl, $data = null, $req_type, $endpoint)
    {

        return curl_setopt_array($curl, array(

            CURLOPT_URL => config('wassenger.api_url') . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $req_type,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "token:" . config('wassenger.api_key'),
            ),

        ));

    }

    public function curlResponse($curl)
    {

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function wassengerSendMessage($mobile_no, $message, $endpoint)
    {
        $curl = curl_init();

        $array = [
            'phone' => '+' . $mobile_no,
            'priority' => $this->priority,
            'message' => $message,
            'device' => $this->device_id,
        ];

        $data = json_encode($array, true);

        $this->curlSetup($curl, $data, 'POST', $endpoint);

        $this->curlResponse($curl);
    }

    public function wassangerGetMessage($msgID)
    {
        $curl = curl_init();

        $this->curlSetup($curl, 'GET', $msgID);

        $this->curlResponse($curl);

    }
}