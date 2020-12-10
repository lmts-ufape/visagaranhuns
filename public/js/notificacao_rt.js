window.avisoReqRt = function($id){

    console.log("TESTE DE ACESSO!");
    CKEDITOR.instances["summary-ckeditor"].setData(document.getElementById("avisoTempRequerimentoRt"+$id).value)

}