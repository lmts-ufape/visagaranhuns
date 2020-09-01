//carregar lista de requerimentos
window.onload= function() {
    $.ajax({
        url:'/requerimento',
        type:"get",
        dataType:'json',
        data: {"filtro": "all" },
        success: function(response){
            $('tbody_').html(response.table_data);
        }
    });
};

window.selecionarFiltro = function(){
    //area
    var historySelectList = $('select#idSelecionarFiltro');
    var $opcao = $('option:selected', historySelectList).val();
    // console.log($opcao);
    $.ajax({
        url:'/requerimento',
        type:"get",
        dataType:'json',
        data: {"id_area": $opcao},
        success: function(response){
            $('tbody').html(response.table_data);
            // document.getElementById('idArea');
        }
    });
}

window.mostrar = function($id){
    if(document.getElementById("cardEstabelecimento"+$id).style.display == "none"){
        document.getElementById("cardEstabelecimento"+$id).style.display = "block";
    }else{
        document.getElementById("cardEstabelecimento"+$id).style.display = "none";
    }
}

window.empresaId = function($empresaId) {
    console.log($empresaId);
    document.getElementById("inputSubmeterId").value = $empresaId;
    document.getElementById("submeterId").submit();
}
