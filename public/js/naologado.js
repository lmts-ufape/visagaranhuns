var tempTipo = "null";
var tempTexto = "null";
var tempImg = "null";

window.mostrarContato = function(tipo, texto, img){

    if(document.getElementById(tipo).style.display == "none"){
        document.getElementById(tipo).style.display = "block";
        document.getElementById(img).style.display = "block";
        document.getElementById(texto).innerHTML="Fechar";

        if(tempTipo != "null" && tempTipo != document.getElementById(tipo)){
            tempTipo.style.display="none";
            tempTexto.innerHTML="Mostrar";
            tempImg.style.display = "none";
            tempTipo = document.getElementById(tipo);
            tempTexto = document.getElementById(texto);
            tempImg = document.getElementById(img);
        }
        tempTipo = document.getElementById(tipo);
        tempTexto = document.getElementById(texto);
        tempImg = document.getElementById(img);
    }else{
        document.getElementById(tipo).style.display = "none";
        document.getElementById(texto).innerHTML="Mostrar";
        document.getElementById(img).style.display = "none";
    }

    // }else{
    //     document.getElementById(tipo).style.display = "none";
    //     document.getElementById(texto).innerHTML="Mostrar";
    //     document.getElementById(img).style.display = "none";
    // }



}
