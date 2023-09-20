<?php 
    //$cnpj = '06990590000123';

    //Variável guarda parte do URL da API
   $url_servico = "https://www.sintegraws.com.br/api/v1/execute-api.php";

   //Nosso token conforme disponibilizado pelo site do Sintegra WS
   $token = "";

   //Parâmetros a serem adicionados
   $params = array(
       'token' => $token, 
       'cnpj' => $cnpj, 
       'plugin' => 'RF'
     );
   //Une o URL com os parâmetros estabelecidos
   $url_servico = $url_servico. "?" . http_build_query($params);


   //Inicia a sessão do cURL
   $curl = curl_init();
   curl_setopt_array($curl, array(
       CURLOPT_URL => $url_servico,
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_TIMEOUT => 90,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "GET",
   ));

   $response = curl_exec($curl);

   $json = json_decode($response);  
?>
