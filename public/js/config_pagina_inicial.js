// ############# servico

window.criarServico = function(){
    let $titulo = document.getElementById('idTitulo').value;
    $.ajax({
        url:'/coordenador/gerenciarconteudo/criar/servico',
        type:"get",
        dataType:'json',
        data: {"titulo": $titulo},
        success: function(response){
            $('tbody').html(response.table_data);
            if(response.success == true){
                if(!alert("Serviço "+$titulo+" criado com sucesso!")){window.location.reload();}
            }else{
                alert("Oops! O serviço "+$titulo+" não foi criado. Tente novamente!");
            }
        }
    });
    //limpar imput
    document.getElementById('idTitulo').value = "";
}
window.deletarServico = function($id){
    $.ajax({
        url:'/coordenador/gerenciarconteudo/deletar/servico',
        type:"get",
        dataType:'json',
        data: {"id": $id.value},
        success: function(response){
            $('tbody').html(response.table_data);
            if(response.success == true){
                if(!alert("Serviço deletado com sucesso!")){window.location.reload();}
            }else{
                alert("Oops! Não foi possível deletar o serviço. Tente novamente!");
            }
        }
    });
}
window.editarServico = function($id, $titulo){
    $.ajax({
        url:'/coordenador/gerenciarconteudo/editar/servico',
        type:"get",
        dataType:'json',
        data: {"id": $id.value, 'titulo':$titulo.value},
        success: function(response){
            $('tbody').html(response.table_data);
            if(response.success == true){
                if(!alert('Serviço editado com sucesso!')){window.location.reload();}
            }else{
                alert("Oops! Não foi possível editar o serviço. Tente novamente!");
            }
        }
    });
}
window.subirPosicaoServico = function($id, $posicao){
    $.ajax({
        url:'/coordenador/gerenciarconteudo/editar/subir/servico',
        type:"get",
        dataType:'json',
        data: {"id": $id, "posicao":$posicao},
        success: function(response){
            $('tbody').html(response.table_data);
        }
    });
}
window.descerPosicaoServico = function($id,$posicao){
    $.ajax({
        url:'/coordenador/gerenciarconteudo/editar/descer/servico',
        type:"get",
        dataType:'json',
        data: {"id": $id, "posicao":$posicao},
        success: function(response){
            $('tbody').html(response.table_data);
        }
    });
}
//atualizar modal - editar
window.editarServicoModal = function($id, $titulo){
    // console.log($id, $titulo);
    document.getElementById("nomeDoServicoEditar").value = $titulo;
    document.getElementById("idServicoEditar").value = $id;
}
//atualizar modal - deletar
window.deletarServicoModal = function($id,$titulo){
    // console.log($id,$titulo);
    document.getElementById("nomeDoServicoDeletar").innerHTML = $titulo;
    document.getElementById("idServicoDeletar").value = $id;
}

// ############# seção

window.criarSecao = function($id){
    let $titulo = document.getElementById('idTituloSecao').value;
    let $descricao = tinyMCE.get('descricaoSecao').getContent();
    let $servico_id = $id;
    $.ajax({
        url:'/coordenador/gerenciarconteudo/criar/secao',
        type:"get",
        dataType:'json',
        data: {"servico_id": $servico_id, "titulo": $titulo, "descricao": $descricao},
        success: function(response){
            $('tbody').html(response.table_data);
            if(response.success == true){
                if(!alert("Seção "+$titulo+" criado com sucesso!")){window.location.reload();}
            }else{
                alert("Oops! A seção "+$titulo+" não foi criado. Tente novamente!");
            }
        }
    });
    // limpar campos
    tinyMCE.get('descricaoSecao').setContent("");
    document.getElementById('idTituloSecao').value="";
}
window.editarSecao = function($id, $titulo){

    let $id_secao = $id.value;
    let $titulo_secao = $titulo.value;
    let $descricao_secao = tinyMCE.get('descricaoSecaoEditar').getContent();
    // console.log($id_secao,$titulo_secao,$descricao_secao);
    $.ajax({
        url:'/coordenador/gerenciarconteudo/editar/secao',
        type:"get",
        dataType:'json',
        data: {"id_secao": $id_secao, 'titulo':$titulo_secao, 'descricao':$descricao_secao},
        success: function(response){
            $('tbody').html(response.table_data);
            if(response.success == true){
                if(!alert("Seção atualizada com sucesso!")){window.location.reload();}
            }else{
                alert("Oops! Não foi possível atualizar a seção. Tente novamente!");
            }
        }
    });
}
window.deletarSecao = function($id, $titulo){
    let $id_secao = $id.value;
    // console.log($id_secao,$titulo_secao,$descricao_secao);
    $.ajax({
        url:'/coordenador/gerenciarconteudo/deletar/secao',
        type:"get",
        dataType:'json',
        data: {"id_secao": $id_secao},
        success: function(response){
            $('tbody').html(response.table_data);
            if(response.success == true){
                if(!alert("Seção deletada com sucesso!")){window.location.reload();}
            }else{
                alert("Oops! Não foi possível deletar a seção. Tente novamente!");
            }
        }
    });
}
//atualizar modal - editar secao
window.editarSecaoModal = function($id, $titulo){
    let descricao = document.getElementById('descricaoConfigSecao'+$id).value;
    document.getElementById("nomeDaSecaoEditar").value = $titulo;
    tinyMCE.get('descricaoSecaoEditar').setContent(descricao);
    document.getElementById("idSecaoEditar").value = $id;
}
//atualizar modal - deletar secao
window.deletarSecaoModal = function($id,$titulo){
    let descricao = document.getElementById('descricaoConfigSecao'+$id).value;
    console.log(descricao);
    document.getElementById("nomeDaSecaoDeletar").value = $titulo;
    tinyMCE.get('descricaoSecaoDeletar').setContent(descricao);
    tinymce.get("descricaoSecaoDeletar").setMode('readonly'); //desabilitar campo de texto
    document.getElementById("idSecaoDeletar").value = $id;
}
