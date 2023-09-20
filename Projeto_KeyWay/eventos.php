<?php  
    include_once "clsEventos.php";

    $Evento = new clsEventos();
    //$_POST['comando'] = "Buscar";
    //$_POST['comando'] = "Cadastrar";
    //$_POST['nome_evento'] = "Teste";
    //$_POST['desc_evento'] = "Teste";
    //$_POST['cat_evento'] = "Cultura";
    //$_POST['data_evento'] = "2022-09-24";
    //$_POST['hora_evento'] = "16:30:00";
    //$_POST['nome_lugar'] = "Espaço Verde Chico Mendes";
    //$_POST['username'] = "estou_cansado";

    if(isset($_POST['comando']))
    {
        $Comando = $_POST['comando'];
    }
    if(isset($_POST['nome_evento']))
    {
        $nome_evento = $_POST['nome_evento'];

        $Evento->setNome($nome_evento);
    }
    if(isset($_POST['desc_evento']))
    {
        $desc_evento = $_POST['desc_evento'];

        $Evento->setDesc($desc_evento);
    }
    if(isset($_POST['cat_evento']))
    {
        $cat_evento = $_POST['cat_evento'];

        $Evento->setCategoria($cat_evento);
    }
    if(isset($_POST['data_evento']))
    {
        $data_evento = $_POST['data_evento'];

        $Evento->setData($data_evento);
    }
    if(isset($_POST['hora_evento']))
    {
        $hora_evento = $_POST['hora_evento'];

        $Evento->setHora($hora_evento);
    }
    if(isset($_POST['nome_lugar']))
    {
        $nome_lugar = $_POST['nome_lugar'];

        $Evento->setLugar($nome_lugar);
      
    }
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];

        $Evento->setUsername($username);
    }


    try
    {
        //Verificar qual comando será enviado do Kodular
        switch($Comando)
        {
            case "Buscar_Todos":
                
                $Resultado = $Evento->buscarTodosEventos();

                $RetornoJSON = json_encode($Resultado);

                echo $RetornoJSON;

                break;
            case "Buscar_Favoritos":
                //Pegando código do user
                $Cod_User = $Evento->buscarCodUser();
                $Evento->setCodUser($Cod_User);

                $Resultado = $Evento->buscarEventosFavoritados();

                $RetornoJSON = json_encode($Resultado);

                echo $RetornoJSON;

                break;

            case "Buscar":
                //Pegando o código do lugar
                $cod_lugar = $Evento->buscarCodLugar();
                $Evento->setCodLugar($cod_lugar);

                $Resultado = $Evento->buscarEventos();

                $RetornoJSON = json_encode($Resultado);

                echo $RetornoJSON;

                break;

            case "Cadastrar":

                //Pegando o código do lugar
                $cod_lugar = $Evento->buscarCodLugar();
                $Evento->setCodLugar($cod_lugar);

                //Pegando o código do Organizador
                $cod_org = $Evento->buscarCodOrganizador();
                $Evento->setCodOrg($cod_org);
                

                $Resultado = $Evento->cadastrarEvento();

                $RetornoJSON = json_encode($Resultado);

                echo $RetornoJSON;
                break;
        }
    }
    catch (PDOException $erro)
    {
        echo "Erro: " . $erro->getMessage();
    }
?>