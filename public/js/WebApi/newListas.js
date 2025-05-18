
console.log('estou aqui');


  $.ajax({
        url: '/listarDados', // A URL onde os dados serão enviados
        type: 'POST',

        dataType: 'json',
     
        success: function (response) {

            console.log(response);

            if (response.Status == 2) {

            


            } else {

            

            }

        },
        error: function (xhr, status, error) {
            console.error('Erro ao enviar:', error);
        }

    });







// fetch('/listarDados') // Chama o endpoint PHP
//     .then(response => response.json()) // Converte a resposta para JSON
//     .then(data => {
//         console.log(data); // Exibe os dados no console
//         document.getElementById("resultado").innerHTML = JSON.stringify(data, null, 2); // Mostra os dados formatados na tela
//     })
//     .catch(error => console.error("Erro ao buscar dados:", error));

