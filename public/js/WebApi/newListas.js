import {
    formatarTelefone,
    validacampos,
    mascaraEmail
} from "../functions/function.js";


$(document).ready(function (){

    listar();
});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('btn-primary')) {
        const valor = event.target.getAttribute('data-valor');
        funcao(valor);
        buscauser(valor);
    }
    if (event.target.classList.contains('btn-danger')) {
        const valor = event.target.getAttribute('data-valor');
        
       
        confirmDelete(valor);


    }if (event.target.classList.contains('btn-info')) {
 

        clearBusca();



    }
    
});

document.getElementById("InputTelEdit").addEventListener("input", function () {

    let resultMask = formatarTelefone(this);

    const divTel = document.getElementById("erroTel");
    if (!resultMask) {
        divTel.innerHTML = 'Verifique o Telefone informado';

    } else {

        divTel.innerHTML = ""
    }

});

document.getElementById("InputEmailEdit").addEventListener("input", function () {
    const divErroMail = document.getElementById("erroEmail");

    if (!mascaraEmail(this.value)) {
        divErroMail.innerHTML = 'Verifique o endereço informado';
        this.classList.add("is-invalid");
    } else {
        divErroMail.innerHTML = "";
        this.classList.remove("is-invalid");
    }
});


//pego o form

document.addEventListener("DOMContentLoaded", function () {

           editForm();

     
});


function listar(){

$.ajax({
    url: '/listarDados',
    type: 'POST',
    dataType: 'json',
    success: function (response) {
       if (response.Status == 2) {
            montarTable(response.data);

        } else {

            alert(response.message);

        }

    },
    error: function (xhr, status, error) {
        console.error('Erro ao enviar:', error);
    }

});

}


function montarTable(data) {

    const table = document.getElementById('tableUsuarios');
   
  $.each(data, function (index, valores) {
      let novaLinha = `
<tr>
    <td>${valores[0]}</td><td>${valores[1]}</td><td>${valores[2]}</td><td>${valores[3]}</td><td>${valores[4]}</td><td>${valores[5]}</td>
    <td>
    <div class="d-flex flex-row bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <button type="button" class="btn btn-primary" data-valor="${valores[0]}" data-toggle="modal" data-target="#ExemploModalCentralizado">Editar</button>
        </div>
        <div class="p-2 bd-highlight">
            <button type="button" class="btn btn-danger" data-valor="${valores[0]}" data-toggle="modal" data-target="#ExemploModalCentralizado">Deletar</button>
        </div>
    </div>
    </td>
</tr>`;
    $("#corpoTabela").append(novaLinha);
});

}


function funcao(dados) {

    $('#ExemploModalCentralizado').modal('show');
}

/**
 * Sends an AJAX POST request to fetch user data by ID and populates form fields with the response.
 *
 * @param {number|string} id - The unique identifier of the user to be fetched.
 *
 * The function expects the server to respond with a JSON object containing:
 *   - Status: {number} Status code (2 indicates success)
 *   - data: {Array[]} Array of user data arrays, where each array contains:
 *       [0]: {string|number} User ID
 *       [1]: {string} User name
 *       [2]: {string} User email
 *       [3]: {string} User telephone
 *       [4]: {string} User date (e.g., registration date)
 *   - message: {string} Error message if Status is not 2
 *
 * On success, the function fills the following input fields:
 *   - #InputNameEdit
 *   - #InputdEdit
 *   - #InputEmailEdit
 *   - #InputTelEdit
 *   - #InputDateEdit
 *
 * Alerts the user if the request fails or the response status is not 2.
 */
function buscauser(id) {

    const dados = {
        id: id
    }

    $.ajax({
        url: '/buscaUser',
        type: 'POST',
        dataType: 'json',
        data: dados,
        success: function (response) {

            console.log(response);
            if (response.Status == 2) {
                let dados = response.data;
                dados.forEach(element => {

                    $('#InputNameEdit').val(element[1]);
                    $('#InputdEdit').val(element[0]);
                    $('#InputEmailEdit').val(element[2]);
                    $('#InputTelEdit').val(element[3]);

                    $('#InputDateEdit').val(element[4]);

                });

            } else {

                alert(response.message);

            }

        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.error('Erro ao enviar:', error);
        }

    });

}


function editForm() {
    let nameEdit, emailEdit, telefoneEdit, dataEdit, idEdit;

    idEdit = $('#InputdEdit').val();
    nameEdit = $('#InputNameEdit').val();
    emailEdit = $('#InputEmailEdit').val();
    telefoneEdit = $('#InputTelEdit').val();
    dataEdit = $('#InputTelEdit').val();

    const erros = validacampos(nameEdit, emailEdit, telefoneEdit);
    const divErro = document.getElementById("erros");

    if (!erros) {
        divErro.innerHTML = erros.map(erro => `<p>${erro}</p>`).join('');
    } else {

        return true;
    }



}
 function confirmDelete(valor)
 {

    if(confirm('Deseja Deletar o Usuário do id :' + valor)){
     
          deletarUsuario(valor);
        
    }


 }
function deletarUsuario(valor){

    const dados = {
        id: valor
 
    }

    $.ajax({
        url: '/deletarUser ',
        type: 'POST',
        dataType: 'json',
        data: dados,
          success: function (response) {

            if (response.Status == 2) {

                setTimeout(() => { alert(response.message)
                     window.location.reload();
                    ;}, 100);

            } else {

                alert(response.message);

            }

        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.error('Erro ao enviar:', error);
        }

    });

}

//aqui e para o search
const busca = document.getElementById('searchInput');
//pego o corpo da da minha tabela criada
const tabela = document.getElementById('corpoTabela');

busca.addEventListener('keyup', ()=>{
   
    let expressao = busca.value.toLowerCase();

    if(expressao.length < 2){
        return;
    }
   
    let linhas =  tabela.getElementsByTagName('tr');
  
     for(let possicao in linhas){

        if(true == isNaN(possicao)){
            continue;
        }

        let conteudoLinha = linhas[possicao].innerHTML.toLowerCase();
        
        if(true === conteudoLinha.includes(expressao)){

             linhas[possicao].style.display = '';

        }else{
              linhas[possicao].style.display = 'none';
        }
        
    }
})

function clearBusca() {
    busca.value = "";
    mostrarTodasAsLinhas();

}
function mostrarTodasAsLinhas() {
    let linhas = tabela.getElementsByTagName('tr');
    for (let i = 0; i < linhas.length; i++) {
        linhas[i].style.display = '';
    }
}