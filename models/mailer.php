<?php

function send_mail($userMail, $userId)
{
    $url = "http://70.34.252.244/vehicle/?aaa=".base64_encode('http://70.34.252.244/vehicle/index.php?controller=login/register&userId='.$userId);

/** Send Mail Function */
    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "codemaster0208@gmail.com",
                'Name' => "CarEye"
            ],
            'To' => [
                [
                    'Email' => $userMail,
                    'Name' => ""
                ]
            ],
            'Subject' => "Zespół CarEye ",
            'HTMLPart' => "Witaj, <br>możesz ustawić swoje hasło odwiedzając ten link: ".$url."<br><br> Zespół CarEye"
            ]
        ]
    ];
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    curl_setopt($ch, CURLOPT_USERPWD, "3ed287a569ae4ca11e1a332766e6d3be:cce01a330532a3384de961d59083fe12");
    $server_output = curl_exec($ch);
    curl_close ($ch);
    
    $response = json_decode($server_output);
    if ($response->Messages[0]->Status == 'success') {
        return true;
    }else{
        return false;
    }
}
