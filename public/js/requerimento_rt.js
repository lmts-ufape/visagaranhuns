window.statusCNAERequisicaoRT = function($flag, $descricao, $aviso, $idCnae, $respTecnico, $empresa){
    
    $.ajax({
        url:'/cnae/encontrar',
        type:"get",
        dataType:'json',
        data: {'cnaeId': $idCnae,
               'respTecnico': $respTecnico,
               'empresa': $empresa,
        },
        success: function(response){
            console.log(response.valor);
            if (response.tipo == "primeira_licenca") {
                console.log("Primeira Licenca");
                if (response.valor == "pendente") {
                    $("option[value='primeira_licenca']").prop("disabled", true);
                    $("option[value='renovacao']").prop("disabled", true);
                }else if (response.valor == "aprovado") {
                    $("option[value='primeira_licenca']").prop("disabled", true);
                    $("option[value='renovacao']").prop("disabled", false);
                }else {
                    $("option[value='primeira_licenca']").prop("disabled", false);
                    $("option[value='renovacao']").prop("disabled", true);
                }
            }else if (response.tipo == "renovacao"){
                console.log("Renovacao");
                if (response.valor == "pendente") {
                    $("option[value='primeira_licenca']").prop("disabled", true);
                    $("option[value='renovacao']").prop("disabled", true);
                }else if (response.valor == "aprovado") {
                    $("option[value='primeira_licenca']").prop("disabled", true);
                    $("option[value='renovacao']").prop("disabled", false);
                }else {
                    $("option[value='primeira_licenca']").prop("disabled", true);
                    $("option[value='renovacao']").prop("disabled", false);
                }
            }else if (response.tipo == "nenhum") {
                console.log("Né");
                $("option[value='primeira_licenca']").prop("disabled", false);
                $("option[value='renovacao']").prop("disabled", true);
            }
        }
    });
    
    if($flag == "reprovado"){

        document.getElementById('descricaoCNAERTreprovado').innerHTML = $descricao;
        document.getElementById('avisoCNAERTreprovado').innerHTML = $aviso;
    }else if($flag == "aprovado"){
        
        document.getElementById('descricaoCNAERT').innerHTML = $descricao;
    }else if($flag == "criarRequisicao"){

        document.getElementById('criarRequerimentoCNAERT').innerHTML = $descricao;
        document.getElementById('idCnaeRequerimentoRT').value = $idCnae;
    }

}

window.avisoReq = function($aviso){
    $("#avisoReq").html($aviso);
}