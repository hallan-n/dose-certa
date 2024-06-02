<?php

class SMS
{
    private $authKey;
    private $apiUrl;

    public function __construct($authKey, $apiUrl = 'https://sms.comtele.com.br/api/v2/send')
    {
        $this->authKey = $authKey;
        $this->apiUrl = $apiUrl;
    }

    public function sendSMS($sender, $receivers, $content)
    {
        $postData = [
            'Sender' => $sender,
            'Receivers' => $receivers,
            'Content' => $content
        ];

        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'auth-key: ' . $this->authKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if (isset($error_msg)) {
            return ['success' => false, 'error' => $error_msg];
        }

        return ['success' => true, 'response' => json_decode($response, true)];
    }
}

?>
