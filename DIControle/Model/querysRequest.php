<?php
    require_once 'instanciaConexaoOracle.php';
	class Funcionalidades extends DB{
        protected $tabelaDefaut = 'testttt';
        private $nome;
        private $email;
        private $adm;

        public function setID($ID){
            $this->ID = $ID;
        }
        public function getID(){
            return $this->ID;
        }

        public function setIP($IP){
            $this->IP = $IP;
        }
        public function getIP(){
            return $this->IP;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getDescricao(){
            return $this->descricao;
        }

        public function setSetor($setor){
            $this->setor = $setor;
        }
        public function getSetor(){
            return $this->setor;
        }

        public function setObservacao($observar){
            $this->observar = $observar;
        }
        public function getObservacao(){
            return $this->observar;
        }

        public function visualizarRegistros(){
            $sql = "SELECT IP,DESCRICAO,LOCALIZACAO,OBSERVACAO FROM  $this->tabelaDefaut ORDER BY ip ASC";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function alteroRegistro(){
            $sql  = "UPDATE $this->tabelaDefaut SET IP=:ip,DESCRICAO=:descricao,LOCALIZACAO=:setor WHERE ip=:ip";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':ip', $this->IP, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(':setor',$this->setor, PDO::PARAM_STR);
            $stmt->execute();
            $checandoEmail = $stmt->rowCount();
            if($checandoEmail > 0){
                return $stmt->fetch();
            }
            else{
                return NULL;
            }
        }

        public function alteroObservacao(){
            $sql  = "UPDATE $this->tabelaDefaut SET OBSERVACAO=:observar WHERE ip=:ip";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':ip', $this->IP, PDO::PARAM_STR);
            $stmt->bindParam(':observar',$this->observar, PDO::PARAM_STR);
            $stmt->execute();
            
        }

    }
?>