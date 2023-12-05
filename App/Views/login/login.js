import HttpClient from "/App/App.js"
const httpClient = new HttpClient()

const form = document.querySelector('.formLogin')
console.log(form)
form.addEventListener('submit', async (e) => {
    e.preventDefault()
    const formdata = new FormData(form)

    httpClient.makeRequest('/api/login', formdata)
    .then(response => {
        console.log(response)
        if(response.ok){
            httpClient.navigateTo('/home')
        }
    })

})