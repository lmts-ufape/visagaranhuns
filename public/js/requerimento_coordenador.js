//carregar lista de requerimentos
// window.onload= function() {
//     $.ajax({
//         url:'/requerimento',
//         type:"get",
//         dataType:'json',
//         data: {"filtro": "all" },
//         success: function(response){
//             $('tbody_').html(response.table_data);
//         }
//     });
// };

// window.selecionarFiltro = function(){
//     //area
//     var historySelectList = $('select#idSelecionarFiltro');
//     var $opcao = $('option:selected', historySelectList).val();
//     // console.log($opcao);
//     $.ajax({
//         url:'/requerimento',
//         type:"get",
//         dataType:'json',
//         data: {"id_area": $opcao},
//         success: function(response){
//             $('tbody').html(response.table_data);
//             // document.getElementById('idArea');
//         }
//     });
// }

// window.selecionarFiltroRequerimento = function($filtro){
//     // console.log($filtro);
//     $.ajax({
//         url:'/requerimento',
//         type:"get",
//         dataType:'json',
//         data: {"filtro": $filtro },
//         success: function(response){
//             $('tbody_').html(response.table_data);
//         }
//     });
// }

window.abrir_fechar_card_requerimento = function($valor){
    console.log($valor);
    if(document.getElementById($valor).style.display == "none"){
        document.getElementById($valor).style.display = "block";
    }else{
        document.getElementById($valor).style.display = "none";
    }
}

window.empresaId = function($empresaId) {
    console.log($empresaId);
    document.getElementById("inputSubmeterId").value = $empresaId;
    document.getElementById("submeterId").submit();
}

window.licencaAvaliacao = function($empresaId, $area, $requerimento) {
    console.log($empresaId);
    console.log($area);
    document.getElementById("licencaAvaliacao").value = $empresaId;
    document.getElementById("areaCnae").value = $area;
    document.getElementById("requerimento").value = $requerimento;
    document.getElementById("licenca").submit();
}
