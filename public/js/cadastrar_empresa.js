window.selecionarArea = function(){
    //area
    var historySelectList = $('select#idSelecionarArea');
    var $id_area = $('option:selected', historySelectList).val();
    $.ajax({
        url:'/estabelecimento/lista/cnae',
        type:"get",
        dataType:'json',
        data: {"id_area": $id_area},
        success: function(response){
            $('tbody').html(response.table_data);
            // document.getElementById('idArea');
        }
    });
}

//array criado para armazenar os cnaes selecionados
var arrayTemp = [];

window.add = function($id) {
    if(arrayTemp.findIndex(element => element == $id) == -1){ //consicao para add o cnae na lista (meus cnaes)

        // innerText sempre pegará o primero texto da lista
        var elemento = document.getElementById($id).innerText;
        linha = montarLinhaInput($id,elemento);
        $('#adicionar').append(linha);
        arrayTemp.push($id);
    }
}

window.deletar = function(obj){

    var index = arrayTemp.findIndex(element => element == obj.value); //encontrar o indice no arrayTemp
    if ( index > -1) {
        arrayTemp.splice(index, 1); //remover o elemento do array
        obj.closest('.form-gerado').remove();
        return false;
    }
}

window.montarLinhaInput = function(id,elemento){

    return " <div class='form-gerado'>\n"+
    "           <div style='margin:10px; padding:10px; border: 1.5px solid #f2f2f2; border-radius: 8px; width:470px'>\n"+
    "               "+elemento+"\n"+
    "               <input type='hidden' name='cnae[]' value='"+id+"'>\n"+
    "           </div>\n"+
    "           <div class='col-md-1'>\n" +
    "               <button type='button' class='btn btn-danger' value='"+id+"' onclick='deletar(this)'>X</button>\n" +
    "           </div>\n"+
    "       </div>\n";
}

