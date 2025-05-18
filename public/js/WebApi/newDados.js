import {
    teste,
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
    document.getElementById("InputTel").addEventListener("input", function () {

        let resultMask = formatarTelefone(this);

        const divTel = document.getElementById("erroTel");
        if (!resultMask) {
            divTel.innerHTML = 'Verifique o Telefone informado';

        } else {

            divTel.innerHTML = ""
        }

    });
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


    const erroEmail = mascaraEmail(email);
    const divErroMail = document.getElementById("erroEmail");
    if (!erroEmail) {
        divErroMail.innerHTML = 'Verifique o endereço informado';
        throw new Error("E-mail inválido!");
    }

    const erros = validacampos(name, email, telefone);
    const divErro = document.getElementById("erros");

    if (erros) {
        divErro.innerHTML = erros.map(erro => `<p>${erro}</p>`).join('');
    } else {

        return true;
    }

}