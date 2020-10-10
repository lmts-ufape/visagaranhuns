window.statusCNAERequisicaoRT = function($flag, $descricao, $aviso, $idCnae){
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
