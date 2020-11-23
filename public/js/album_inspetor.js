
let $inspecao_id_temp;

window.mostrarImagemInspecao = function($caminho){
    document.getElementById("imgAlbumInspecao").src = "/imagens/inspecoes/"+$caminho;
}
window.deletarImagemInspecao = function($id){
    document.getElementById("inspecao_id_inspetor").value = $id;
}
window.modalImagemInspecao = function($id, $id_crypt, $textOriginal){
    $inspecao_id_temp = $id;

    let $comentarioTextAreaFoto = tinyMCE.get('comentarioImagem'+$id).getContent();
    //console.log($textOriginal, $comentarioTextAreaFoto);
    if($comentarioTextAreaFoto.length == 0){ //nenhuma modificacao e cliquei em salvar
        document.getElementById("modalSalvarComentarioFoto_InspetorCor").style.backgroundColor = '#ff0000';
        document.getElementById("modalTextoSalvarComentarioImagem_Inspetor").innerHTML = 'Insira um comentário antes de clicar em salvar!';
        document.getElementById("botaoSalvarComentarioModal_inspetor").disabled = true;
    }else if($comentarioTextAreaFoto === $textOriginal){ //nenhuma modificacao no texto e cliquei em salvar
        document.getElementById("modalSalvarComentarioFoto_InspetorCor").style.backgroundColor = '#ff0000';
        document.getElementById("modalTextoSalvarComentarioImagem_Inspetor").innerHTML = 'Não é possível salvar o mesmo comentário!';
        document.getElementById("botaoSalvarComentarioModal_inspetor").disabled = true;
    }else{ //modifiquei e cliquei em salvar
        document.getElementById("modalSalvarComentarioFoto_InspetorCor").style.backgroundColor = '#009900';
        document.getElementById("modalTextoSalvarComentarioImagem_Inspetor").innerHTML = 'Tem certeza de que deseja salvar o comentário?';
        document.getElementById("botaoSalvarComentarioModal_inspetor").disabled = false;
    }
}
window.saveComentario = function(){
    document.getElementById("savaComentarioFotoInspecao_inspetor"+$inspecao_id_temp).submit();
}
