// listar.js
// /usuarios/listar
import HttpClient from "/frontend/App.js"
const httpClient = new HttpClient()

const deletePessoa = async (tdItem, nome = '') => {

    if(!confirm(`Deseja excluir o usuário ${nome}?`)) return

    const response = await httpClient.makeRequest('/api/usuarios/excluir', {id: tdItem.getAttribute('data-id')})
    if(response.ok) {
        tdItem.remove()
    }
}

const listarPessoas = async () => {
    await new Promise(resolve => setTimeout(resolve, 500))
    let response = await httpClient.makeRequest('/api/usuarios/listar')

    const usuarios = response.usuarios
    document.querySelector('#loading').style.display = 'none'

    let tbody = document.querySelector('#tablePessoas tbody') 
    usuarios?.forEach(usuario => {
        let row = document.createElement('tr')
        row.setAttribute('data-id', usuario.id)
        
        let tdId = document.createElement('td')
        tdId.innerHTML = usuario.id
        row.appendChild(tdId)

        let tdNome = document.createElement('td')
        tdNome.innerHTML = usuario.nome
        row.appendChild(tdNome)

        let tdButton = document.createElement('td')
        let button = document.createElement('button')
        button.classList.add('btn')
        button.classList.add('btn-danger')
        button.innerHTML = '<i class="fa fa-trash"></i> Excluir'
        button.addEventListener('click', (e) => {
            deletePessoa(row, usuario.nome)
        })
        tdButton.appendChild(button)
        row.appendChild(tdButton)
        tbody.appendChild(row)
    })
}

listarPessoas()