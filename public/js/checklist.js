window.foundChecklist = function($checklistId, $empresaId){
    // console.log($empresaId);
    $.ajax({
        url:'/foundChecklist',
        type:"get",
        dataType:'json',
        data: {"checklistId": $checklistId,
                "empresaId": $empresaId },
        success: function(response){
            // console.log(response);
            $('#foundChecklist').attr('value', response.checklist);
            $('#foundEmpresa').attr('value', response.empresa);
        }
    });
}