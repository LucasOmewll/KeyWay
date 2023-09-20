<?php 
    include_once "clsMarcados.php";

    $Marcados = new clsMarcados();

    //$_POST['comando'] = "Marcar";
    //$_POST['username'] = "testando_marcados_3";
    //$_POST['cod_evento'] = "1";

    if(isset($_POST['comando']))
    {
        $comando = $_POST['comando'];
    }
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        $Marcados->setUsername($username);
    }
    if(isset($_POST['evento']))
    {
        $evento = $_POST['evento'];
        $Marcados->setEvento($evento);
    }

    switch($comando)
    {
        case 'Marcar':
                //Pegando o código do usuário
                $cod_user = $Marcados->buscarCodUser();
                $Marcados->setCodUser($cod_user);

                //Pegando o código do evento
                $cod_evento = $Marcados->buscarCodEvento;
                $Marcados->setCodEvento($cod_evento);

                $Resultado = $Marcados->marcar();

                $RetornoJSON = json_encode($Resultado);

                echo $RetornoJSON;

            break;

        case 'Desmarcar':

            break;

        case 'Buscar':

            break;
    }
?>