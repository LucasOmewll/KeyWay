<?php 
    include_once "clsLikes.php";

    $Likes = new clsLikes();

    //$_POST['comando'] = "Buscar";
    //$_POST['lugar'] = "Espaço Verde Chico Mendes";
    //$_POST['username'] = "userteste78";

    if(isset($_POST['comando']))
    {
        $comando = $_POST['comando'];
    }
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        $Likes->setUsername($username);
    }
    if(isset($_POST['lugar']))
    {
        $lugar = $_POST['lugar'];
        $Likes->setLugar($lugar);
    }

    switch($comando)
    {
        case 'Buscar':
            //Pegando o código do lugar
            $cod_lugar = $Likes->buscarCodLugar();
            $Likes->setCod_Lugar($cod_lugar);

            $Resultado = $Likes->buscar_likes();

            echo json_encode($Resultado);
            break;

        case 'Curtir':
            //Pegando o código do lugar
            $cod_lugar = $Likes->buscarCodLugar();
            $Likes->setCod_Lugar($cod_lugar);

            //Pegando o código do usuário
            $cod_user = $Likes->buscarCodUser();
            $Likes->setCodUser($cod_user);

            $Resultado = $Likes->dar_like();

            echo json_encode($Resultado);
            break;
        case 'Remover':
            //Pegando o código do lugar
            $cod_lugar = $Likes->buscarCodLugar();
            $Likes->setCod_Lugar($cod_lugar);

            //Pegando o código do usuário
            $cod_user = $Likes->buscarCodUser();
            $Likes->setCodUser($cod_user);

            $Resultado = $Likes->remover_like();

            echo json_encode($Resultado);
            break;
        case 'Buscar_Curtida_User':
            //Pegando o código do lugar
            $cod_lugar = $Likes->buscarCodLugar();
            $Likes->setCod_Lugar($cod_lugar);
            
            //Pegando o código do usuário
            $cod_user = $Likes->buscarCodUser();
            $Likes->setCodUser($cod_user);

            $Resultado = $Likes->buscar_curtida_do_user();

            echo json_encode($Resultado);
            break;
            
            
    }
?>