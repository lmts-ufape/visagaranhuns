var tempTipo = "null";
var tempTexto = "null";
var tempImg = "null";

window.mostrarContato = function(tipo, texto, img){
    if(tipo == "mostrar1"){
        if(document.getElementById("mostrar1").style.display == "block"){
            document.getElementById("mostrar1").style.display = "none";
            document.getElementById("mostrar2").style.display = "block";
            document.getElementById("texto1").innerHTML="Mostrar";
            document.getElementById("texto2").innerHTML="Fechar";
            document.getElementById("img1").style.display = "none";
            document.getElementById("img2").style.display = "block";
        }else if(document.getElementById("mostrar1").style.display == "none"){
            document.getElementById("mostrar1").style.display = "block";
            document.getElementById("mostrar2").style.display = "none";
            document.getElementById("texto1").innerHTML="Fechar";
            document.getElementById("texto2").innerHTML="Mostrar";
            document.getElementById("img1").style.display = "block";
            document.getElementById("img2").style.display = "none";
        }
    }else if(tipo == "mostrar2"){
        if(document.getElementById("mostrar2").style.display == "block"){
            document.getElementById("mostrar2").style.display = "none";
            document.getElementById("mostrar1").style.display = "block";
            document.getElementById("texto2").innerHTML="Mostrar";
            document.getElementById("texto1").innerHTML="Fechar";
            document.getElementById("img2").style.display = "none";
            document.getElementById("img1").style.display = "block";
        }else if(document.getElementById("mostrar2").style.display == "none"){
            document.getElementById("mostrar2").style.display = "block";
            document.getElementById("mostrar1").style.display = "none";
            document.getElementById("texto2").innerHTML="Fechar";
            document.getElementById("texto1").innerHTML="Mostrar";
            document.getElementById("img2").style.display = "block";
            document.getElementById("img1").style.display = "none";
        }
    }
}
