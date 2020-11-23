window.avisoReqRt = function($id){
    tinyMCE.get('avisoRequerimentoRt').setContent(document.getElementById("avisoTempRequerimentoRt"+$id).value);
    tinymce.get("avisoRequerimentoRt").setMode('readonly'); //desabilitar campo de texto
}