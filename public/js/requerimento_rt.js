

window.avisoReq = function($id){
    console.log($id);
    CKEDITOR.instances["summary-ckeditor"].setData(document.getElementById("teste"+$id).value)
    // tinyMCE.get('avisoRequerimentoEmpresa').setContent();
    // tinymce.get("avisoRequerimentoEmpresa").setMode('readonly'); //desabilitar campo de texto
}

window.avisoRequerimentoRt = function($id){
    console.log($id);
    CKEDITOR.instances["summary-ckeditor"].setData(document.getElementById("avisoTempRequerimentoRt"+$id).value)

}
