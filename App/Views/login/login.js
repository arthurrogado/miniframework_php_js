import HttpClient from "/App/App.js"
const httpClient = new HttpClient()

const form = document.querySelector('.formLogin')
console.log(form)
form.addEventListener('submit', async (e) => {
    e.preventDefault()
    const formdata = new FormData(form)

    fetch('/api.php/login/login', {
        method: 'POST',
        body: formdata
    }).then(response => response.json())
    .then(response => {
        console.log(response)
        if(response.ok) {
            new httpClient.Info("Login feito com sucesso!", "success", 3000)
            form.reset()
        } else {
            new httpClient.Info("Erro: " + response?.message , "danger", 3000)
        }
    })

})