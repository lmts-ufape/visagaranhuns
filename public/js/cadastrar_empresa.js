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
//
// window.add = function($id_cnae){
//     // console.log("opa");
//     $.ajax({
//         url:'/estabelecimento/add/meusCnae',
//         type:"get",
//         dataType:'json',
//         data: {"id_cnae": $id_cnae},
//         success: function(response){
//             $('tbodyz').html(response.table_data);
//             // document.getElementById('idArea');
//         }
//     });
// }

window.add = function(id) {
    // innerText sempre pegará o primero texto da lista
    var elemento = document.getElementById(id).innerText;
    linha = montarLinhaInput(id,elemento);
    $('#adicionar').append(linha);
}


window.deletar = function(obj){
    obj.closest('.form-gerado').remove();
    return false;
}

window.montarLinhaInput = function(id,elemento){

    return " <div class='form-gerado'>\n"+
    "           <div style='margin:10px; padding:10px; border: 1.5px solid #f2f2f2; border-radius: 8px; width:470px'>\n"+
    "               "+elemento+"\n"+
    "               <input type='hidden' name='cnae[]' value='"+id+"'>\n"+
    "           </div>\n"+
    "           <div class='col-md-1'>\n" +
    "               <input type='button' class='btn btn-danger' value='X' onclick='deletar(this)' />\n" +
    "           </div>\n"+
    "       </div>\n";
}

