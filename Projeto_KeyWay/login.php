<?php 
    //ÚLTIMA MUDANÇA FEITA EM 20/07/2022 ÀS 10:28

    include "conexao_bd.php";

    if(isset($_POST['email']))
    {
        $email = $_POST['email'];
    }
    if(isset($_POST['senha']))
    {
        $senha = $_POST['senha'];
    }

    try
    {
        $comando = $conexao->prepare("SELECT senha FROM tab_users  WHERE tab_users.email = ?");
        $comando->bindParam(1,$email);

        if($comando->execute())
        {
            //pega a senha criptografada no banco de dado, transforma em uma string e coloca na variável $senha_hashed
            $senha_hashed = implode($comando->fetch(PDO::FETCH_ASSOC));

            //verifica se a senha dada pelo usuário corresponde com a senha criptografada
            if(password_verify($senha, $senha_hashed))
            {
                $RetornoJSON = json_encode("SENHA CORRETA");	
		        echo $RetornoJSON;

                $email = null;
                $senha = null;
            }
            else
            {
                $RetornoJSON = json_encode("SENHA Incorreta");	
		        echo $RetornoJSON;
            }
        }
        else
        {
            throw new PDOException("Erro: não possível executar o comando SQL");
        }
    }
    catch(PDOException $erro)
    {
        echo "Erro: " .$erro->getMessage();
    }
?>