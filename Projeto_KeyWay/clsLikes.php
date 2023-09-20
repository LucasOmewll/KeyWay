<?php 
    include "conn_bd_OOP.php";

    class clsLikes
    {
        //======== ATRIBUTOS ========
        private $Lugar;
        private $Likes;
        private $Username;
        private $Cod_User;
        private $Cod_Lugar;

        //GET e SET do espaço
        public function getLugar()
        {
            return $this->Lugar;
        }
        public function setLugar($Lug)
        {
            $this->Lugar = $Lug;
        }

        //GET e SET da curtida
        public function getLikes()
        {
            return $this->Likes;
        }
        public function setLikes($Lik)
        {
            $this->Likes = $Lik;
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
        public function getCodLugar()
        {
            return $this->Cod_Lugar;
        }
        public function setCod_Lugar($Cod_L)
        {
            $this->Cod_Lugar = $Cod_L;
        }

        //======== MÉTODOS ========
        public function buscar_likes()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "SELECT COUNT(cod_favoritados) AS likes FROM tab_espacos_favoritados WHERE cod_spaces = (?)";
            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_Lugar);

            $stm->execute();

            $result = $stm->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public function dar_like()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "INSERT INTO tab_espacos_favoritados (cod_user, cod_spaces) VALUES (?, ?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_User);
            $stm->bindValue(2, $this->Cod_Lugar);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = " Favoritado com sucesso.";
                return $result;
            }
            else
            {
                $result = "Erro ao favoritar, tente novamente.";
                return $result;
            }
        }

        public function remover_like()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "DELETE FROM tab_espacos_favoritados WHERE cod_user = (?) AND cod_spaces = (?)";

            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_User);
            $stm->bindValue(2, $this->Cod_Lugar);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = "Espaço removido de seus favoritos.";
                return $result;
            }
            else
            {
                $result = "Erro ao remover o favorito, tente novemente.";
                return $result;
            }
        }
        
        public function buscar_curtida_do_user()
        {
            $bd = new Conexao();
            $con = $bd->getConexao();

            $SQL = "SELECT cod_favoritados FROM tab_espacos_favoritados WHERE cod_spaces = (?) AND cod_user = (?)";
            $stm = $con->prepare($SQL);
            $stm->bindValue(1, $this->Cod_Lugar);
            $stm->bindValue(2, $this->Cod_User);

            $stm->execute();

            if($stm->rowCount()>0)
            {
                $result = "marked";
                return $result;
            }
            else
            {
                $result = "not_marked";
                return $result;
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