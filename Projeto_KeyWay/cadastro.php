<?php 
    //ÚLTIMA MUDANÇA FEITA EM 18/07/2022 ÀS 21:07 POR LUCAS

    include "conexao_bd.php";

    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
    }
    if(isset($_POST['nome_de_usuario']))
    {
        $nome_de_usuario = $_POST['nome_de_usuario'];
    }
    if(isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
    }
    if(isset($_POST['senha']))
    {
        $senha = $_POST['senha'];
    }
    if(isset($_POST['nome_imagem']))
    {
        $nome_imagem = $_POST['nome_imagem'];
    }

    //criptografa a senha de acordo com o algorítmo definido
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    try
    {
        $comando = $conexao->prepare("INSERT INTO tab_users (nome, email, senha, username, nome_imagem) VALUES (?,?,?,?,?)");
        $comando->bindParam(1, $nome);
        $comando->bindParam(2, $email);
        $comando->bindParam(3, $senha_hashed);
        $comando->bindParam(4, $nome_de_usuario);
        $comando->bindParam(5, $nome_imagem);

        if($comando->execute())
        {
            if($comando->rowCount() > 0)
            {
                $nome = null;
                $email = null;
                $senha = null;
                $senha_hashed = null;
                $nome_de_usuario = null;
                $nome_imagem = null;

                $resultado = "SUCESSO NO CADASTRO";
                $retornoJSON = json_encode($resultado);

                echo $retornoJSON;
            }
            else
            {
                $resultado = "ERRO NO CADASTRO";
                $retornoJSON = json_encode($resultado);

                echo $retornoJSON;
            }
        }
        else
        {
            throw new PDOException("Erro: não foi possível executar comando SQL");
        }
    }
    catch(PDOException $erro)
    {
        echo "Erro: " .$erro->getMessage();
    }
?>