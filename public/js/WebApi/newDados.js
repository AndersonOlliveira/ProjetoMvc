import {

    validacampos,
    mascaraEmail,
    formatarTelefone,
    saveStorage,
    pushStorage
} from '../functions/function.js';
///envio dados para processar no script de funcoes

//ira chamar a função depois que todo o dom estriver carregado
document.addEventListener("DOMContentLoaded", function () {
   //limpo o storage com um botão
    const clear = document.getElementById('clearStorage');
    clear.addEventListener('click', e => {
        e.preventDefault();
        
        localStorage.clear();
        document.getElementById('enviodados').reset();

    });
  //puxo os dados para se carregado no dom
    pushStorage();
    
});

//envia o form somente depois que tudo for finalizado
const form = document.getElementById('enviodados')
form.addEventListener('submit', e => {
    e.preventDefault();


    if (submiTBootom()) { //se for true envio o formulario

        form.submit();
    }

});

function submiTBootom() {
    let name, email, telefone, data;

    name = $('#InputName').val();
    email = $('#InputEmail').val();
    telefone = $('#InputTel').val();
    data = $('#InputDate').val();

    //salvo no storage para recuperar caso a pagina de erro
    saveStorage($('#InputName').val(), $('#InputEmail').val(), $('#InputTel').val(), $('#InputDate').val());

    const erros = validacampos(name, email, telefone);
    const divErro = document.getElementById("erros");

     //pego os erros
    if (erros) {
        divErro.innerHTML = erros.map(erro => `<p>${erro}</p>`).join('');
    } else {
        return true;
    }

}
//aqui valido o email enviando para uma função no momento que o user esta digitando
document.getElementById("InputEmail").addEventListener("input", function () {
    const divErroMail = document.getElementById("erroEmail");

    if (!mascaraEmail(this.value)) {
        divErroMail.innerHTML = 'Verifique o endereço informado';
        this.classList.add("is-invalid");
    } else {
        divErroMail.innerHTML = "";
        this.classList.remove("is-invalid");
    }
});


//aqui valido o telefone enviando para uma função no momento que o user esta digitando
document.getElementById("InputTel").addEventListener("input", function () {

    let resultMask = formatarTelefone(this);

    const divTel = document.getElementById("erroTel");
    if (!resultMask) {
        divTel.innerHTML = 'Verifique o Telefone informado';
         this.classList.add("is-invalid");

    } else {

         divTel.innerHTML = "";
         this.classList.remove("is-invalid");
    }

});