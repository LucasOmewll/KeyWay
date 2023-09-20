<?php
    //ÚLTIMA MUDANÇA FEITA EM 18/07/2022 ÀS 20:45 POR LUCAS
    //Mudança realizada: Criação do arquivo e desenvolvimento da rotina de conexão entre o aplicativo e o banco de dados

    $banco_de_dados = "keyway";
    $usuario = "root";
    $senha = "";

    try 
    {
        $conexao = new PDO("mysql:host=localhost;dbname=$banco_de_dados","$usuario","$senha");
        $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $conexao-> exec("set names utf8");
    }
    catch (PDOException $erro)
    {
        echo "Erro na conexão com o banco de dados:" . $erro->getMessage();
    }
?>