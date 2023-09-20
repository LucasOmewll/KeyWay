<?php 
    include "conexao_bd.php";

    //$_POST['username'] = "userteste78";
    //$_POST['cnpj'] = "06990590000123";
    
    if(isset($_POST['cnpj']))
    {
        $cnpj = $_POST['cnpj'];
    }
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
    }

    //função de validar o número de cnpj fornecido
    include_once "validar_cnpj.php";


    try
    {
        //Caso do número for válido, irá consultar as informações da empresa através da API da Receita Federal
        if(validar_cnpj($cnpj))
        {

            include_once "API_receita_federal.php";

            //verifica o código do retorno da API
            /*Código | Status | Mensagem
              0        OK       Pesquisa realizada com sucesso.
              1	       OK       CNPJ não tem cadastro na Receita federal.
              2        ERROR    CNPJ inválido.
              3        ERROR    Token inválido.
              4        ERROR    Usuário não contratou nenhum pacote de créditos.
              5        ERROR    Os créditos contratados acabaram.
              6        ERROR    Plugin não existe.
              7        ERROR    Site da Receita federal esta com instabilidade.
              8        ERROR    Ocorreu um erro interno, por favor contatar o nosso suporte.           
            */
            switch ($json->code)
            {
                case 0:
                    
                    if($json->situacao == "ATIVA")
                    {
                        $id_do_usuario = " ";
                        
                        $buscar_id = $conexao->prepare("SELECT cod_user FROM tab_users WHERE username = ?");
                        $buscar_id->bindParam(1, $username);

                        if($buscar_id->execute())
                        {
                            $id_do_usuario = implode($buscar_id->fetch(PDO::FETCH_ASSOC));
                        }

                        $comando = $conexao->prepare("INSERT INTO tab_organizers (cod_user, username, nome, email_contato, tel_contato, cnpj, cep, uf) VALUES (?,?,?,?,?,?,?,?)");
                        $comando->bindParam(1, $id_do_usuario);
                        $comando->bindParam(2, $username);
                        $comando->bindParam(3, $json->nome);
                        $comando->bindParam(4, $json->email);
                        $comando->bindParam(5, $json->telefone);
                        $comando->bindParam(6, $json->cnpj);
                        $comando->bindParam(7, $json->cep);
                        $comando->bindParam(8, $json->uf);

                        if($comando->execute())
                        {
                            $resultado = "SUCESSO";
                            $retornoJSON = json_encode($resultado);

                            echo $retornoJSON;
                        }
                        else
                        {
                            $resultado = "ERRO";
                            $retornoJSON = json_encode($resultado);
            
                            echo $retornoJSON;
                        }
                    }
                    else
                    {
                        throw new Exception("Situação consta como " .$json->situacao);
                    }
                    break;

                default:
                    throw new Exception($json->code ." - ". $json->status . " - " . $json->message);
                    break;
            }
   
        }
        else
        {
            throw new Exception("Insira um CNPJ VÁLIDO");
        }
    }
    catch (PDOException $erro)
    {
        echo "Erro: " .$erro->getMessage();
    }
    catch(Exception $erro_02)
    {
        echo "Erro: " .$erro_02->getMessage();
    }
?>