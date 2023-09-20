<?php 
    if(isset($_POST['lugar']))
    {
      $lugar = $_POST['lugar'];  
    }
    if(isset($_POST['coordenadas']))
    {
        $coordenadas = $_POST['coordenadas'];
    }
    
    
    
    $url_servico = "https://geocode.search.hereapi.com/v1/geocode";

    //Chave da API disponibilizada pela Here
    $api_key = " ";

    //Parâmetros a serem adicionados
    $params = array(
        'q' => $lugar,
        'at' => $coordenadas,
        'apiKey' => $api_key, 
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

   echo $response;
?>
