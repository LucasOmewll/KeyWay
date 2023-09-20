<?php 
    include "conn_bd_OOP.php";

    class clsMarcados
    {
        //======== ATRIBUTOS ========
        private $Evento;
        private $Marcados;
        private $Username;
        private $Cod_User;
        private $Cod_Evento;

        //GET e SET do espaço
        public function getEvento()
        {
            return $this->Lugar;
        }
        public function setEvento($Evn)
        {
            $this->Evento = $Evn;
        }

        //GET e SET da curtida
        public function getMarcados()
        {
            return $this->Marcados;
        }
        public function setMarcados($Mar)
        {
            $this->Marcados = $Mar;
        }

        //GET e SET do Username
        public function getUsername()
        {
            return $this->Username;
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

        //GET e SET do código do espaço
        public function getCodEvento()
        {
            return $this->Cod_Evento;
        }
        public function setCodEvento($Cod_E)
        {
            $this->Cod_Evento = $Cod_E;
        }

        //======== MÉTODOS ========

        public function buscar_marcados()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "SELECT COUNT(cod_marcados) AS marcados FROM tab_eventos_marcados WHERE cod_events = (?)";
            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_Evento);

            $stm->execute();

            $result = $stm->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function marcar()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "INSERT INTO tab_eventos_marcados (cod_user, cod_events) VALUES (?, ?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_User);
            $stm->bindValue(2, $this->Cod_Evento);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = "Marcado com sucesso.";
                return $result;
            }
            else
            {
                $result = "Erro ao marcar presença, tente novamente.";
                return $result;
            }
        }

        public function retirar_marcado()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "DELETE FROM tab_eventos_marcados WHERE cod_user = (?) AND cod_events = (?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_User);
            $stm->bindValue(2, $this->Cod_Evento);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = "Evento removido de seus marcados.";
                return $result;
            }
            else
            {
                $result = "Erro ao remover a presença, tente novemente.";
                return $result;
            }
        }

        public function buscarCodUser()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT cod_user FROM tab_users WHERE username = (?)";

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

        public function buscarCodEvento()
        {
            $bd = new Conexao();
		    $con = $bd->getConexao();

            $SQL = "SELECT cod_events FROM tab_events WHERE nome = (?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Evento);

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