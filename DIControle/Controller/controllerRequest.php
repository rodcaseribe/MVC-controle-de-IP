<?php 
    function validaSetor($nomeSetor){   
        require('../View/envinronments.php');
        if (in_array($nomeSetor, $setores)) { 
           return $nomeSetor;
        }else{
            return null;
        }
    }

    function validaIP($IP){
        $rangeIPCIDR = ['192', '168', '0', '1','2','3'];
        if(substr($IP,0,3)==$rangeIPCIDR[0] && substr($IP,4,3)==$rangeIPCIDR[1]){
            $IPValido =  substr($IP,0,3).".".substr($IP,4,3);
            for($subRede1=0;$subRede1<=3;$subRede1++){
                if(substr($IP,8,3)==$subRede1){
                    $IPValido = $IPValido.".".substr($IP,8,3);
                    for($subRede2=1;$subRede2<=254;$subRede2++){
                        if(substr($IP,12)==$subRede2){
                            $IPValido = $IPValido.".".substr($IP,12);
                            return $IPValido;
                        }
                    }
                }
            }
        }
        else{
            return null;
        }
    }

    function visualizaoInicial(){
        require('./Model/instanciaConexaoOracle.php');
        require('./Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        return $checkQuery->visualizarRegistros();
    }


    
    if(isset($_POST["valorID"]) && isset($_POST["IPAlteracao"]) && isset($_POST["DescricaoAlteracao"]) && isset($_POST["SetorAlteracao"])){
        require('../Model/instanciaConexaoOracle.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        $checkQuery->setID($_POST["valorID"]);
        $checkQuery->setIP(validaIP($_POST["valorID"]));
        $checkQuery->setDescricao($_POST["DescricaoAlteracao"]);
        if(validaSetor($_POST["SetorAlteracao"])!=null && validaIP($_POST["valorID"])!=null){
            $checkQuery->setSetor($_POST["SetorAlteracao"]);
            if($checkQuery->alteroRegistro()==NULL){
                echo json_encode(array("erro" => 1, "mensagem" => "Registro alterado"));
            }
            else{
                echo json_encode(array("erro" => 0, "mensagem" => "Conflito de IP - IP existente"));
            }
        }
        else{
            echo json_encode(array("erro" => 1, "mensagem" => "Erro de alteração de setores ou IP"));
        }
    }
    

    if(isset($_POST["valorID"]) && isset($_POST["observacao"])){
        require('../Model/instanciaConexaoOracle.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        $checkQuery->setID($_POST["valorID"]);
        $checkQuery->setIP(validaIP($_POST["valorID"]));
        $checkQuery->setObservacao($_POST["observacao"]);
        $checkQuery->alteroObservacao();
    }


    if(isset($_POST["visualGlobal"])){
        require('../Model/instanciaConexaoOracle.php');
        require('../Model/querysRequest.php');
        $conexao = new DB();
        $conexao->getInstance();
        $checkQuery = new Funcionalidades();
        echo json_encode(array("registros" => $checkQuery->visualizarRegistros()));
    }

?>