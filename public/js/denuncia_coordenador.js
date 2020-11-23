window.abrir_fechar_card_requerimento = function($valor){
    console.log($valor);
    if(document.getElementById($valor).style.display == "none"){
        document.getElementById($valor).style.display = "block";
    }else{
        document.getElementById($valor).style.display = "none";
    }
}

window.empresaIdDenuncia = function($empresaId) {
    console.log($empresaId);
    document.getElementById("inputSubmeterIdDenuncia").value = $empresaId;
    document.getElementById("submeterIdDenuncia").submit();
}

window.licencaAvaliacao = function($empresaId, $area, $requerimento) {
    console.log($empresaId);
    console.log($area);
    document.getElementById("licencaAvaliacao").value = $empresaId;
    document.getElementById("areaCnae").value = $area;
    document.getElementById("requerimento").value = $requerimento;
    document.getElementById("licenca").submit();
}

window.denuncia = function($descricao){
    console.log($descricao);
    tinyMCE.get('modalDenuncia').setContent($descricao);
    tinymce.get("modalDenuncia").setMode('readonly'); //desabilitar campo de texto
}

window.denunciaId = function($id){
    console.log($id);
    document.getElementById("denunciaIdArquivar").value = $id;
    document.getElementById("denunciaIdAcatar").value = $id;
}

