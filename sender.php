<?php
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $queryUrl = 'https://b24-x18kac.bitrix24.ru/rest/1/s16zvj6vs0r4h672/crm.lead.add.json';

    $queryData = http_build_query(array(
      'fields' => array(
        'TITLE' => 'Request',
        'NAME' => $name,
        'EMAIL' => Array(
          "n0" => Array(
            "VALUE" => "$email",
          ),
        ),
        'PHONE' => Array(
          "n0" => Array(
            "VALUE" => "$phone",
          ),
        ),
      ),
      'params' => array("REGISTER_SONET_EVENT" => "Y")
    ));

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $queryUrl,
      CURLOPT_POSTFIELDS => $queryData,
    ));
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, 1);
    if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
?>