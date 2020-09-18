// window.selecionarArea = function(){
//     //area
//     var historySelectList = $('select#idSelecionarArea');
//     var $id_area = $('option:selected', historySelectList).val();
//     $.ajax({
//         url:'/estabelecimento/lista/cnae',
//         type:"get",
//         dataType:'json',
//         data: {"id_area": $id_area},
//         success: function(response){
//             $('tbody').html(response.table_data);
//             // document.getElementById('idArea');
//         }
//     });
// }

//array criado para armazenar os cnaes selecionados
var arrayTemp = [];

window.add = function($id) {
    if(arrayTemp.findIndex(element => element == $id) == -1){ //consicao para add o cnae na lista (meus cnaes)

        // innerText sempre pegará o primero texto da lista
        var elemento = document.getElementById($id).innerText;
        linha = montarLinhaInput($id,elemento);
        $('#adicionar').append(linha);
        arrayTemp.push($id);
    }
}

window.deletar = function(obj){

    var index = arrayTemp.findIndex(element => element == obj.value); //encontrar o indice no arrayTemp
    if ( index > -1) {
        arrayTemp.splice(index, 1); //remover o elemento do array
        obj.closest('.form-gerado').remove();
        return false;
    }
}

window.montarLinhaInput = function(id,elemento){

    return " <div class='form-gerado cardMeuCnae'>\n"+
    "           <div class='d-flex'>\n"+
    "           <div class='mr-auto p-2'>\n"+
    "               "+elemento+"\n"+
    "               <input type='hidden' name='cnae[]' value='"+id+"'>\n"+
    "           </div>\n"+
    "           <div class='p-2'>\n" +
    "               <button type='button' class='btn btn-danger' value='"+id+"' onclick='deletar(this)'>X</button>\n" +
    "           </div>\n"+
    "           <div>\n"+
    "       </div>\n";
}

window.meu_callback = function(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('cidade').value=(conteudo.localidade);
        document.getElementById('uf').value=(conteudo.uf);

    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

window.limpa_formulário_cep = function () {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value=("");
    document.getElementById('bairro').value=("");
    document.getElementById('cidade').value=("");
    document.getElementById('uf').value=("");
}

window.pesquisacep = function(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');
    console.log(cep);
    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value="...";
            document.getElementById('bairro').value="...";
            document.getElementById('cidade').value="...";
            document.getElementById('uf').value="...";


            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}

var tempIdCard = -1;
window.mostrarBotaoAdicionar = function(valor){
    if(tempIdCard == -1){
        document.getElementById("cardSelecionado"+valor).style.display = "block";
        this.tempIdCard=document.getElementById("cardSelecionado"+valor);
    }else if(tempIdCard != -1){
        tempIdCard.style.display = "none";
        document.getElementById("cardSelecionado"+valor).style.display = "block";
        this.tempIdCard=document.getElementById("cardSelecionado"+valor);

    }

}

