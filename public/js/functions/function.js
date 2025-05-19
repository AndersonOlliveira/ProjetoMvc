function validarCampo(campo, nomeCampo) {
    if (campo == '' || campo == null) {
        return `Campo ${nomeCampo} não pode ser vazio.`;
        
    }
    return false; 
}


export function validacampos (name,email,telefone){

      let erros = [];

    if (validarCampo(name, 'Nome')) erros.push(validarCampo(name, 'Nome'));
    if (validarCampo(email, 'E-mail')) erros.push(validarCampo(email, 'E-mail'));
    if (validarCampo(telefone, 'Telefone')) erros.push(validarCampo(telefone, 'Telefone'));
   

    if (erros.length > 0) {
        return erros; 
    }

    return false;

}
export function mascaraEmail(email){

    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(regex.test(email)){
        return true;
    }else{
        return false;
    }


}

export function formatarTelefone(campo) {

    
    let numero = campo.value.replace(/\D/g, ''); 
    if (numero.length >= 11) {
        campo.value = numero.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        return true;
    } else{ 
        return false;
    }
}

export function saveStorage(name,email,telefone){
   
    localStorage.setItem('nome', name); 
    localStorage.setItem('email', email);
    localStorage.setItem('telefone', telefone);

}
export function pushStorage(){
    let nomeStorage = localStorage.getItem('nome');
    let emailStorage = localStorage.getItem('email');
    let telefoneStorage = localStorage.getItem('telefone');
    if (nomeStorage) document.getElementById('InputName').value = nomeStorage;
    if (emailStorage) document.getElementById('InputEmail').value = emailStorage;
    if (telefoneStorage) document.getElementById('InputTel').value = telefoneStorage;
}