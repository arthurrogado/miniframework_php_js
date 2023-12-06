import HttpClient from "/frontend/App.js"
const httpClient = new HttpClient()

let form = document.querySelector('#formCriarPessoa')
form.addEventListener('submit', (e) => {
    e.preventDefault()
    let formdata = new FormData(form)

    httpClient.makeRequest('/api/usuarios/criar', formdata)
    .then(response => {
        console.log(response)
        if(response.ok) {
            httpClient.navigateTo('/usuarios/listar')
        }
    })

})