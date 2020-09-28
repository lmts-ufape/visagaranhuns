
window.findDoc = function($id){
    console.log($id);
    $.ajax({
        url:'/encontrar/doc',
        type:"get",
        dataType:'json',
        data: {"id": $id},
        success: function(response){
            $('#editarDoc').val(response.nome);
        }
    });
}