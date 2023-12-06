// listar.js
// /pessoas/listar
import HttpClient from "/frontend/App.js"
const httpClient = new HttpClient()

const deletePessoa = async (tdItem, nome = '') => {

    const response = await httpClient.makeRequest('/api/pessoas/deletar', {id: tdItem.getAttribute('data-id')})
    if(response.ok) {
        tdItem.remove()
    }
}

const listarPessoas = async () => {
    await new Promise(resolve => setTimeout(resolve, 500))
    let response = await httpClient.makeRequest('/api/pessoas/listar')

    const pessoas = response.pessoas
    document.querySelector('#loading').style.display = 'none'

    let tbody = document.querySelector('#tablePessoas tbody') 
    pessoas.forEach(pessoa => {
        let row = document.createElement('tr')
        row.setAttribute('data-id', pessoa.id)
        
        let tdId = document.createElement('td')
        tdId.innerHTML = pessoa.id
        row.appendChild(tdId)

        let tdNome = document.createElement('td')
        tdNome.innerHTML = pessoa.nome
        row.appendChild(tdNome)

        let tdButton = document.createElement('td')
        let button = document.createElement('button')
        button.innerHTML = 'Deletar'
        button.addEventListener('click', (e) => {
            deletePessoa(row, pessoa.nome)
        })
        tdButton.appendChild(button)
        row.appendChild(tdButton)
        tbody.appendChild(row)
    })
}

listarPessoas()