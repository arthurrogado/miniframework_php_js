

let form = document.querySelector('#formCriarPessoa')
form.addEventListener('submit', (e) => {
    e.preventDefault()
    let formdata = new FormData(form)

    
    fetch('/api.php/pessoas/create', {
        method: 'POST',
        body: formdata
    }).then(response => response.json())
    .then(response => {
        console.log(response)
        if(response.ok) {
            // window.location.href = '/pessoas/listar'
        }
    })

})