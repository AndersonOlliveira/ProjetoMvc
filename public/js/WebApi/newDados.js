import {

    validacampos,
    mascaraEmail,
    formatarTelefone,
    saveStorage,
    pushStorage
} from '../functions/function.js';


//ira chamar a função depois que todo o dom estriver carregado
document.addEventListener("DOMContentLoaded", function () {

    const clear = document.getElementById('clearStorage');
    clear.addEventListener('click', e => {
        e.preventDefault();
        console.log('clicado')
        localStorage.clear();
        document.getElementById('enviodados').reset();

    });

    // limpar()
    //puxo os dados para se carregado no dom
    pushStorage();
    
});




//pego o form
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

    saveStorage($('#InputName').val(), $('#InputEmail').val(), $('#InputTel').val(), $('#InputDate').val());

    // const erroEmail = mascaraEmail(email);
    //   console.log(erroEmail);
  
    // const divErroMail = document.getElementById("erroEmail");
    // if (!erroEmail) {
    //     divErroMail.innerHTML = 'Verifique o endereço informado';
    //     throw new Error("E-mail inválido!");
    // }

    const erros = validacampos(name, email, telefone);
    const divErro = document.getElementById("erros");

    if (erros) {
        divErro.innerHTML = erros.map(erro => `<p>${erro}</p>`).join('');
    } else {

        return true;
    }

}

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