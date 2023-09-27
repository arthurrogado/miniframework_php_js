// listar.js
// (/pessoas/listar)
import Info from '/App/components/InfoBox.js'
// para informar à IDE que deve procurar o arquivo na pasta public/App/App.js
// e não na pasta App/Views/pessoas/listar/App/App.js
import HttpClient from '/App/App.js'

const deletePessoa = async (id) => {
    let formdata = new FormData()
    formdata.append('id', id)
    let response = await fetch(`/api.php/pessoas/delete`, {
        method: 'POST',
        body: formdata
    })
    response = await response.json()
    if(response.ok) {
        new Info('#pessoas', "Pessoa deletada com sucesso!")
        const httpClient = new HttpClient()
        httpClient.alert('Pessoa deletada com sucesso!')
        // window.location.reload()
    }
}

const listarPessoas = async () => {
    await new Promise(resolve => setTimeout(resolve, 500))
    let response = await fetch('/api.php/pessoas/get_pessoas')
    response = await response.json()
    const pessoas = response.pessoas
    document.querySelector('#loading').style.display = 'none'

    let tbody = document.querySelector('#tablePessoas tbody') 
    pessoas.forEach(pessoa => {
        let row = document.createElement('tr')
        
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
            deletePessoa(pessoa.id)
        })
        tdButton.appendChild(button)
        row.appendChild(tdButton)
        tbody.appendChild(row)
    })
}

listarPessoas()