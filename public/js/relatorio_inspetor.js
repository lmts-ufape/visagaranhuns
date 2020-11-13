window.salvarRelatorio_Inspetor = function($relatorioOld){
   let $relatorioTextAreaFoto = tinyMCE.get('textarea_relatorio_inspetor').getContent();
   //noa tem nada no textarea
   if($relatorioTextAreaFoto == ""){
    document.getElementById("modalAvisoRelatorio_InspetorCor").style.backgroundColor = '#ff0000';
    document.getElementById("modalAvisoRelatorio_InspetorTitulo").innerHTML = 'Aviso';
    document.getElementById("modalTextoRelatorio_InspetorTexto").innerHTML = 'Você precisa escrever algo antes de clicar em salvar!';
    document.getElementById("modalSalvarRelatorio_InspetorBotao").disabled = true;
    //escreveu algo mas o relatorio anterior tá igual ao novo
   }else if($relatorioTextAreaFoto != "" && $relatorioOld === $relatorioTextAreaFoto){
    document.getElementById("modalAvisoRelatorio_InspetorCor").style.backgroundColor = '#ff0000';
    document.getElementById("modalAvisoRelatorio_InspetorTitulo").innerHTML = 'Aviso';
    document.getElementById("modalTextoRelatorio_InspetorTexto").innerHTML = 'Você não pode salvar o relatório sem fazer alguma modificação!';
    document.getElementById("modalSalvarRelatorio_InspetorBotao").disabled = true;
   }else{
    document.getElementById("modalAvisoRelatorio_InspetorCor").style.backgroundColor = '#009900';
    document.getElementById("modalAvisoRelatorio_InspetorTitulo").innerHTML = 'Salvar relatório';
    document.getElementById("modalTextoRelatorio_InspetorTexto").innerHTML = 'Você tem certeza que deseja salvar o relatório?';
    document.getElementById("modalSalvarRelatorio_InspetorBotao").disabled = false;
   }
}

window.saveRelatorio = function(){
    document.getElementById("form_relatorio_inspetor").submit();
}
