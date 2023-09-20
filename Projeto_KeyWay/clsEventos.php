<?php
    include "conn_bd_OOP.php";

    class clsEventos
    {
        // ===== ATRIBUTOS =====
        private $Nome;
        private $Desc;
        private $Data;
        private $Hora;
        private $Categoria;
        private $Marcados;
        private $Lugar;
        private $CodLugar;
        private $Username;
        private $CodOrg;
        private $Cod_User;

        public function getNome()
        {
            return $this->Nome;
        }
        public function setNome($Nom)
        {
            $this->Nome = $Nom;
        }

        public function getDesc()
        {
            return $this->Desc;
        }
        public function setDesc($Des)
        {
            $this->Desc = $Des;
        }

        public function getData()
        {
            return $this->Data;
        }
        public function setData($Dat)
        {
            $this->Data = $Dat;
        }

        public function getHora()
        {
            return $this->Hora;
        }
        public function setHora($Hor)
        {
            $this->Hora = $Hor;
        }

        public function getCategoria()
        {
            return $this->Categoria;
        }
        public function setCategoria($Cat)
        {
            $this->Categoria = $Cat;
        }

        public function getMarcados()
        {
            return $this->Marcados;
        }
        public function setMarcados($Mar)
        {
            $this->Marcados = $Mar;
        }

        public function getLugar()
        {
            return $this->Lugar;
        }
        public function setLugar($Lug)
        {
            $this->Lugar = $Lug;
        }

        public function getCodLugar()
        {
            return $this->CodLugar;
        }
        public function setCodLugar($Cod)
        {
            $this->CodLugar = $Cod;
        }

        public function getCodOrg()
        {
            return $this->CodOrg;
        }
        public function setCodOrg($Org)
        {
            $this->CodOrg = $Org;
        }

        public function getUsername()
        {
            return $this->CodOrg;
        }
        public function setUsername($Usr)
        {
            $this->Username = $Usr;
        }

        //GET e SET do código do usuário
        public function getCodUser()
        {
            return $this->Cod_User;
        }
        public function setCodUser($Cod_U)
        {
            $this->Cod_User = $Cod_U;
        }

        // ===== MÉTODOS =====

        public function buscarTodosEventos()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT tab_events.cod_events, tab_events.nome, tab_events.descricao, tab_events.data_evento, tab_events.hora_start,tab_events.categoria, tab_events.foto_evento, tab_organizers.nome AS organizador, tab_spaces.nome AS nome_lugar
            FROM tab_events
            LEFT JOIN tab_organizers ON  tab_organizers.cod_organizers = tab_events.cod_organizers
            LEFT JOIN tab_spaces ON tab_spaces.cod_spaces = tab_events.cod_spaces";

            $stm = $con->prepare($SQL);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
            else
            {
                $result = "NENHUM EVENTO LOCALIZADO";
                return $result;
            }
        }
        
        public function buscarEventosFavoritados()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT 
            tab_events.cod_events,
            tab_events.nome,
            tab_events.descricao,
            tab_events.data_evento,
            tab_events.hora_start,
            tab_events.categoria,
            tab_events.foto_evento,
            tab_organizers.nome AS organizador,
            tab_spaces.nome AS nome_lugar
            FROM
            tab_events
            LEFT JOIN
            tab_organizers ON tab_organizers.cod_organizers = tab_events.cod_organizers
            LEFT JOIN
            tab_spaces ON tab_spaces.cod_spaces = tab_events.cod_spaces
            LEFT JOIN 
            tab_espacos_favoritados ON tab_espacos_favoritados.cod_spaces = tab_events.cod_spaces
            WHERE tab_espacos_favoritados.cod_user = (?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_User);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
            else
            {
                $result = "NENHUM EVENTO LOCALIZADO";
                return $result;
            }
        }

        public function buscarEventos()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT tab_events.cod_events, tab_events.nome, tab_events.descricao, tab_events.data_evento, tab_events.hora_start,tab_events.categoria, tab_events.foto_evento, tab_organizers.nome AS organizador, tab_spaces.nome AS nome_lugar
            FROM tab_events
            LEFT JOIN tab_organizers ON  tab_organizers.cod_organizers = tab_events.cod_organizers
            LEFT JOIN tab_spaces ON tab_spaces.cod_spaces = tab_events.cod_spaces
            WHERE tab_events.cod_spaces = (?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->CodLugar);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
            else
            {
                $result = "NENHUM EVENTO LOCALIZADO";
                return $result;
            }
        }

        public function cadastrarEvento()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "insert into tab_events (cod_organizers,cod_spaces,nome,descricao,data_evento,hora_start,categoria) 
            values (?,?,?,?,?,?,?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->CodOrg);
            $stm->bindValue(2, $this->CodLugar);
            $stm->bindValue(3, $this->Nome);
            $stm->bindValue(4, $this->Desc);
            $stm->bindValue(5, $this->Data);
            $stm->bindValue(6, $this->Hora);
            $stm->bindValue(7, $this->Categoria);

            if($stm->execute())
            {
                if($stm->rowCount()>0)
                {
                    $result = "SUCESSO NO CADASTRO";
                    return $result;
                }
                else
                {
                    
                    $result = "FALHA NO CADASTRO";
                    return $result;
                }
            }
            else
            {
                throw new PDOException("Não foi possível executar comando SQL");
            }
        }

        public function buscarCodLugar()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT cod_spaces FROM tab_spaces WHERE nome = (?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Lugar);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = implode($stm->fetch(PDO::FETCH_ASSOC));
                return $result;
            }
            else
            {
                $result = "CÓDIGO NÃO ENCONTRADO";
                return $result;
            }
        }

        public function buscarCodOrganizador()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT cod_organizers FROM tab_organizers WHERE username = ?";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Username);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = implode($stm->fetch(PDO::FETCH_ASSOC));
                return $result;
            }
            else
            {
                $result = "CÓDIGO NÃO ENCONTRADO";
                
                return $result;
            }           
        }

        public function buscarCodUser()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT cod_user FROM tab_users WHERE username = ?";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Username);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = implode($stm->fetch(PDO::FETCH_ASSOC));
                return $result;
            }
            else
            {
                $result = "CÓDIGO NÃO ENCONTRADO";
                
                return $result;
            }           
        }
        
    }

?>