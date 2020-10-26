//modal
window.abrirModalMeusDadosEmpresa = function(nomeAtual, nomeModificado){
    if(nomeAtual != nomeModificado.value && (nomeModificado.value).length > 0){
        document.getElementById("idCorCabecalhoModalEditarMeusDados").style.backgroundColor = "#06a94d";
        document.getElementById("idTituloDaMensagemMeusDadosEmpresa").innerHTML = "Você deseja alterar seu nome?";
        document.getElementById("botaoIdAtualizarMeusDadosEmpresa").style.display = "block";
        $("#exampleModalAtualizarMeusDadosEmpresa").modal({show: true});
    }else if(nomeAtual == nomeModificado.value){
        document.getElementById("idCorCabecalhoModalEditarMeusDados").style.backgroundColor = "#1492e6";
        document.getElementById("idTituloDaMensagemMeusDadosEmpresa").innerHTML = "Nenhuma alteração no campo nome";
        document.getElementById("botaoIdAtualizarMeusDadosEmpresa").style.display = "none";
        $("#exampleModalAtualizarMeusDadosEmpresa").modal({show: true});
    }
}
//submit
window.submitAtualizarMeusDadosEmpresa = function(){
    document.getElementById("formEditarMeusDadosEmpresa").submit();

}
