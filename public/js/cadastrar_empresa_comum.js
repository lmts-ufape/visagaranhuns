// window.selecionarArea1 = function(){
//     //area
//     var historySelectList = $('select#idSelecionarArea');
//     var $id_area = $('option:selected', historySelectList).val();
//     $.ajax({
//         url:'/empresa/lista/cnae',
//         type:"get",
//         dataType:'json',
//         data: {"id_area": $id_area},
//         success: function(response){
//             $('tbody').html(response.table_data);
//             // document.getElementById('idArea');
//         }
//     });
// }
