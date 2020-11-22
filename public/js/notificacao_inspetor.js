window.salvarNotificacaoInspetor = function($relatorioOld){
    let $relatorioTextAreaFoto = tinyMCE.get('textarea_notificacao').getContent();
    //noa tem nada no textarea
    if($relatorioTextAreaFoto == ""){
     document.getElementById("modalAvisoNotificacao_InspetorCor").style.backgroundColor = '#ff0000';
     document.getElementById("modalAvisoNotificacao_InspetorTitulo").innerHTML = 'Aviso';
     document.getElementById("modalTextoNotificacao_InspetorTexto").innerHTML = 'Você precisa escrever algo antes de clicar em salvar!';
     document.getElementById("modalSalvarNotificacao_InspetorBotao").disabled = true;
     //escreveu algo mas o relatorio anterior tá igual ao novo
    }else if($relatorioTextAreaFoto != "" && $relatorioOld === $relatorioTextAreaFoto){
     document.getElementById("modalAvisoNotificacao_InspetorCor").style.backgroundColor = '#ff0000';
     document.getElementById("modalAvisoNotificacao_InspetorTitulo").innerHTML = 'Aviso';
     document.getElementById("modalTextoNotificacao_InspetorTexto").innerHTML = 'Você não pode salvar a notificação sem fazer alguma modificação!';
     document.getElementById("modalSalvarNotificacao_InspetorBotao").disabled = true;
    }else{
     document.getElementById("modalAvisoNotificacao_InspetorCor").style.backgroundColor = '#009900';
     document.getElementById("modalAvisoNotificacao_InspetorTitulo").innerHTML = 'Salvar Notificação';
     document.getElementById("modalTextoNotificacao_InspetorTexto").innerHTML = 'Tem certeza que deseja salvar a notificação?';
     document.getElementById("modalSalvarNotificacao_InspetorBotao").disabled = false;
    }
 }
 
 window.saveNotificacao = function(){
     document.getElementById("form_notificacao_inspetor").submit();
 }
 