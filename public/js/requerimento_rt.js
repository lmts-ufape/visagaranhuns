window.statusCNAERequisicaoRT = function($flag, $descricao, $aviso, $idCnae, $respTecnico, $empresa){
    console.log($idCnae);
    console.log($respTecnico);
    console.log($empresa);
    $.ajax({
        url:'/cnae/encontrar',
        type:"get",
        dataType:'json',
        data: {"cnaeId": $idCnae,
               "respTecnico": $respTecnico,
               "empresa": $empresa
        },
        success: function(response){
            console.log("PASSOU AQUI!");
            if (response.valor == "pendente" || response.valor == "aprovado") {
                $("option[value='primeira_licenca']").attr("disabled", "disabled");
                $("option[value='renovacao']").attr("disabled", "disabled");
            }
        }
    });
    console.log("PASSOU AQUI 2!");
    if($flag == "reprovado"){
        console.log("REPROVADO!");
        document.getElementById('descricaoCNAERTreprovado').innerHTML = $descricao;
        document.getElementById('avisoCNAERTreprovado').innerHTML = $aviso;
    }else if($flag == "aprovado"){
        console.log("APROVADO!");
        document.getElementById('descricaoCNAERT').innerHTML = $descricao;
    }else if($flag == "criarRequisicao"){
        console.log("CRIAR REQUISICAO!");
        document.getElementById('criarRequerimentoCNAERT').innerHTML = $descricao;
        document.getElementById('idCnaeRequerimentoRT').value = $idCnae;
    }

}
