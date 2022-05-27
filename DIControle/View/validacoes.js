$.getScript("View/environments.js", function() {

});


function alterarView(value){
    document.getElementById("idNumeroDescricao-"+value).disabled=false;
    document.getElementById("selectPadrao-"+value).disabled=false;
    document.getElementById("confirmaAlteracao-"+value).style.display = "inline";
    document.getElementById("botaoAlterar-"+value).style.display = "none";
}


function confirmaAlteracao(value){
    IP = document.getElementById("idNumeroIP-"+value).value;
    campoDescricaoAlteracao = document.getElementById("idNumeroDescricao-"+value).value;
    campoSetorAlteracao = document.getElementById("selectPadrao-"+value).value;
    if (confirm("Confirma Alteração de Dados?") == true) {
            $.ajax({
                url: "Controller/controllerRequest.php",
                type: "POST",            
                data: {
                    valorID: value,
                    IPAlteracao: IP,
                    DescricaoAlteracao: campoDescricaoAlteracao,
                    SetorAlteracao:  campoSetorAlteracao
                },
                success: function(retorno){
                    retorno = JSON.parse(JSON.stringify(retorno));
                    if(retorno["erro"]){
                        alert("Conflito de IP - IP já cadastrado");
                    }
                    else{
                        alert("Alteração realizada");
                        document.getElementById("botaoAlterar-"+value).style.display = "inline";
                        document.getElementById("confirmaAlteracao-"+value).style.display = "none";
                        document.getElementById("idNumeroDescricao-"+value).disabled=true;
                        document.getElementById("selectPadrao-"+value).disabled=true;
                    }
                },
                error: function(){
                    console.log("Ocorreu um erro durante a solicitação");
                }
            });
    }


}

function inserirObservacao(value){
    campoObservacao = document.getElementById("observacao-"+value).value;
    if (confirm("Confirma Alteração de Dados?") == true) {
        $.ajax({
            url: "Controller/controllerRequest.php",
            type: "POST",            
            data: {
                valorID: value,
                observacao: campoObservacao,
            },
            success: function(retorno){
                retorno = JSON.parse(JSON.stringify(retorno));
                if(retorno["erro"]){
                    alert("erro de alteração");
                }
                else{
                    alert("Alteração realizada");
                    value = value.replace(/\./g, "");
                    for(var i=0;i<=document.getElementsByClassName("fechamento"+value).length-1;i++){
                        document.getElementsByClassName("fechamento"+value)[i].click();
                    }
                }
            },
            error: function(){
                console.log("Ocorreu um erro durante a solicitação");
            }
        });
    }
}