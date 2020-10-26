

window.avisoReq = function($id){
    tinyMCE.get('avisoRequerimentoEmpresa').setContent(document.getElementById("teste"+$id).value);
    tinymce.get("avisoRequerimentoEmpresa").setMode('readonly'); //desabilitar campo de texto
}
window.avisoReqRt = function($id){
    tinyMCE.get('avisoRequerimentoRt').setContent(document.getElementById("avisoTempRequerimentoRt"+$id).value);
    tinymce.get("avisoRequerimentoRt").setMode('readonly'); //desabilitar campo de texto
}
