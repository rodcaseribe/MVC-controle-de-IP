<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <meta charset="utf-8"/>
        <meta name="descricao" content="DIControle na Web"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
        .col-2 { width: 8.66666667% !important;}
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="https://getbootstrap.com/docs/4.1/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>
<body>
    <?php
        include('View/envinronments.php');
        require('./Controller/controllerRequest.php');
        echo '<main role="main" class="container" align="center" style="    padding-right: 60px;">';
        echo '<h1 class="mt-5"><img style="width:100px;height:50px" src="https://gautom.com.br/wp-content/uploads/2021/03/logo-tsc.jpg">&nbsp;DIControle na Web</h1></img><br><br>';
        echo '</main>';
        echo '<form style="padding-left: 200px; margin-right: -200px;">';
        echo '<div class="row">';
        echo '<div class="col-2" style="width: 14.66666667% !important;">';
        echo '<input  style="text-align: center;background-color: white;" type="text"  class="form-control "  placeholder="IP" disabled>';
        echo '</div>';
        echo '<div class="col-3" >';
        echo '<input type="text"  class="form-control"  placeholder="Descricao"  style="background-color: white;" disabled>';
        echo '</div>';
        echo '<div class="col-2" >';
        echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="background-color: white;color:#337ab7;">Observações</button>';
        echo '<div class="modal fade"  role="dialog">';
        echo '<div class="modal-dialog">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h4 class="modal-title">Observaçoes do IP:</h4>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<p></p>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">fechar</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';  
        echo '</div>';
        echo '<div class="col-sm-2">';
        echo '<select class="custom-select mr-sm-2"  disabled>';
        echo '<option selected>SETOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
        echo '</select>';
        echo '</div>';
        echo '<div class="col-2" >';
        echo '<p  class="btn btn-success alterar " style="background-color: white;color:#337ab7;">Operação</p>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        $registros = visualizaoInicial();
        foreach ($registros as $value) {
            if($value['ip']!='   .   .   .   ' && $value['ip']!='127.000.000.001' && $value['ip']!='192.168. 0 .152' && $value['ip']!='192.168.0  .152'){
                echo '<form style="padding-left: 200px; margin-right: -200px;>"';
                echo '<div class="row">';
                echo '<div class="col-2" style="width: 14.66666667% !important;">';
                $checkIPCIDR1= substr($value['ip'],0,3);
                $checkIPCIDR2= substr($value['ip'],4,3);
                $checkIPCIDR3 = substr($value['ip'],10,1);
                if(substr($value['ip'],12)>=100){
                    $checkIPCIDR4 = substr($value['ip'],12);
                }
                else if (substr($value['ip'],12)<=100 && substr($value['ip'],12)>=10){
                    $checkIPCIDR4 = substr($value['ip'],13);
                }
                else{
                    $checkIPCIDR4 = substr($value['ip'],14);
                }
                $cidrCompleto = $checkIPCIDR1.".".$checkIPCIDR2.".".$checkIPCIDR3.".".$checkIPCIDR4;
                echo '<input  style="    text-align: center;" type="text" id="idNumeroIP-'. $value['ip'] .'" class="form-control " placeholder="IP" value="'. $cidrCompleto .'"  disabled>';
                echo '</div>';
                echo '<div class="col-3" >';
                echo '<input style="" type="text" id="idNumeroDescricao-'. $value['ip'] .'" class="form-control"  placeholder="Descricao" value="'. utf8_encode($value['descricao']) .'"  disabled>';
                echo '</div>';
                $valorIP = str_replace('.', '', $value['ip']);
                echo '<div class="col-2">';
                echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#'. $valorIP .'">Observações</button>';
                echo '<div class="modal fade" id="'. $valorIP .'" role="dialog">';
                echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h4 class="modal-title">Observaçoes do IP: '. $value['ip'] .'</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<input type="text" id="observacao-'. $value['ip'] .'" class="form-control"  value="'. utf8_encode($value['observacao']) .'"  enabled>';
                echo '</div>';
                echo '<div class="modal-footer">';
                if(isset($value['observacao'])==NULL){
                    echo '<p onclick="inserirObservacao(\''. $value['ip'] .'\')" class="btn btn-primary alterar2 '. $value['ip'] .'">Inserir Observacaoo</p>';
                }
                else{
                    echo '<p onclick="inserirObservacao(\''. $value['ip'] .'\')" class="btn btn-primary alterar2 '. $value['ip'] .'">Alterar Observacao</p>';
                }
                echo '<button  type="button" class="btn btn-default fechamento'.$valorIP.'" data-dismiss="modal">fechar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';  
                echo '</div>';
                echo '<div class="col-sm-2">';
                echo '<select class="custom-select mr-sm-2" id="selectPadrao-'. $value['ip'] .'" disabled>';
                echo '<option selected>'. $value['localizacao'] .'</option>';
                foreach ($setores as $nomeSetores) {
                    echo '<option value="'. $nomeSetores .'">'.$nomeSetores.'</option>';
                }
                echo '</select>';
                echo '</div>';
                echo '<div class="col-2" id="botaoAlterar-'. $value['ip'] .'">';
                echo '<p onclick="alterarView(\''.$value["ip"] .'\')" class="btn btn-success alterar '. $value['ip'] .'">Alterar Descrição</p>';
                echo '</div>';
                echo '<div class="col-2" style="display: none;" id="confirmaAlteracao-'. $value['ip'] .'">';
                echo '<p onclick="confirmaAlteracao(\''. $value['ip'] .'\')" class="btn btn-primary alterar2 '. $value['ip'] .'">Confirmar Alteração</p>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
            }
        }
    ?>
</body>
</html>
<script src="View/validacoes.js"></script>
