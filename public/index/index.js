// index.js
import HttpClient from "/App/App.js"

const httpClient = new HttpClient()
document.querySelectorAll('nav').forEach(el => {
    el.addEventListener('click', (event) => {
        event.preventDefault()
        httpClient.navigateTo(event.target.getAttribute('href'))
    })
})