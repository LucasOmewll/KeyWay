<?php 
    include "conexao_bd.php";

    try
    {
        $comando = $conexao->prepare("SELECT nome, cidade, uf FROM tab_spaces");

        if($comando->execute())
        {
            $Resultado = $comando->fetchAll(PDO::FETCH_ASSOC);

            $RetornoJSON = json_encode($Resultado);
            
            echo $RetornoJSON;
        }
        else
        {
            throw new Exception("Não foi possível executar o comando SQL.");
            
        }
    }
    catch (PDOException $erro)
    {
        echo "Erro: " .$erro->getMessage();
    }
?>