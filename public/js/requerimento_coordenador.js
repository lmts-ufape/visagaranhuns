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

window.mostrar = function($id){
    if(document.getElementById("cardEstabelecimento"+$id).style.display == "none"){
        document.getElementById("cardEstabelecimento"+$id).style.display = "block";
    }else{
        document.getElementById("cardEstabelecimento"+$id).style.display = "none";
    }
}
