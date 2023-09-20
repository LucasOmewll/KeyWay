<?php 
    include "conn_bd_OOP.php";

    class clsUser
    {
        private $Username;
        private $Cod_User;
        private $Nome;
        private $Foto;

        //===== MÉTODOS ===== 

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

        //GET e SET do nome
        public function getNome()
        {
            return $this->Nome;
        }
        public function setNome($Nom)
        {
            $this->Nome = $Nom;
        }

        //GET e SET da foto
        public function getFoto()
        {
            return $this->Foto;
        }
        public function setFoto($Fot)
        {
            $this->Foto = $Fot;
        }
    }
?>