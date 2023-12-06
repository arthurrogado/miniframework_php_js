import HttpClient from "/frontend/App.js"
const httpClient = new HttpClient()

import infoBox from "/frontend/components/InfoBox.js"

let form = document.querySelector('#formCriarPessoa')
form.addEventListener('submit', (e) => {
    e.preventDefault()
    let formdata = new FormData(form)

    httpClient.makeRequest('/api/pessoas/criar', formdata)
    .then(response => {
        console.log(response)
        if(response.ok) {
            httpClient.navigateTo('/pessoas/listar')
        }
    })

})