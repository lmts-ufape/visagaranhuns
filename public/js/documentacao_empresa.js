function verificarArquivoAnexado_Empresa(){
    let arquivo = document.getElementById("arquivoSelecionado_empresa");

    if(arquivo.files[0].type.split('/')[1] != "pdf"){
        document.getElementById("idCorCabecalhoModalDocumentoEmpresa").style.backgroundColor = "red";
        document.getElementById("idTituloDaMensagemModalDocumentoEmpresa").innerHTML = "O arquivo selecionado não é do tipo .PDF! ";
        $("#exampleModalAnexarDocumentoEmpresa").modal({show: true});
        document.getElementById("arquivoSelecionado_empresa").value = "" //limpar a o input
    }else if(arquivo.files[0].size > 5000000 && arquivo.files[0].type.split('/')[1] == "pdf"){
        document.getElementById("idCorCabecalhoModalDocumentoEmpresa").style.backgroundColor = "red";
        document.getElementById("idTituloDaMensagemModalDocumentoEmpresa").innerHTML = "O arquivo selecionado é maior que 5mb!";
        $("#exampleModalAnexarDocumentoEmpresa").modal({show: true});
        document.getElementById("arquivoSelecionado_empresa").value = "" //limpar a o input
    }
}

function verificarArquivoAnexado_Empresa_Edit(){
    let arquivo = document.getElementById("arquivoSelecionado_edit");

    if(arquivo.files[0].type.split('/')[1] != "pdf"){
        document.getElementById("idCorCabecalhoModalDocumentoEdit").style.backgroundColor = "red";
        document.getElementById("idTituloDaMensagemModalDocumentoEdit").innerHTML = "O arquivo selecionado não é do tipo .PDF! ";
        $("#exampleModalAnexarDocumentoEdit").modal({show: true});
        document.getElementById("arquivoSelecionado_edit").value = "" //limpar a o input
    }else if(arquivo.files[0].size > 5000000 && arquivo.files[0].type.split('/')[1] == "pdf"){
        document.getElementById("idCorCabecalhoModalDocumentoEdit").style.backgroundColor = "red";
        document.getElementById("idTituloDaMensagemModalDocumentoEdit").innerHTML = "O arquivo selecionado é maior que 5mb!";
        $("#exampleModalAnexarDocumentoEdit").modal({show: true});
        document.getElementById("arquivoSelecionado_edit").value = "" //limpar a o input
    }
}
