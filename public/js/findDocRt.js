
window.findDocRt = function($id){
    console.log($id);
    $.ajax({
        url:'/encontrar/doc/rt',
        type:"get",
        dataType:'json',
        data: {"id": $id},
        success: function(response){
            $('#editarDocRt').val(response.nome);
        }
    });
}