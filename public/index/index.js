// index.js
// alert("Ainda tô no index.js")
import HttpClient from "../App/App.js"

window.HttpClient = HttpClient

let global = 'GLOBAL VARIABLE'
window.global = global

// GLOBAL VARIABLES
let main = 'main'

// Liten sidebar button
document.querySelectorAll('nav').forEach(el => {
    el.addEventListener('click', (event) => {
        event.preventDefault()
        navigateTo(event)
        // loadPage(event.target.getAttribute('href'))
        // urlLocationHandler()
    })
})


const urlRoutes = {
    404: {
        title: 'Página não encontrada',
        description: 'A página que você está tentando acessar não existe.',
        template: '/templates/404.html'
    },
    '/': {
        title: 'Home',
        description: 'Página inicial do site.',
        template: '/templates/home.html'
    },
    "/publico": {
        title: 'Público',
        template: '/templates/publico.html',
    },
    "/contato": {
        title: 'Contato',
        route: '/contato',
        description: 'Página de contato.',
    },
    "/sobre_nos": {
        title: 'Sobre nós',
        route: '/sobre_nos',
        description: 'Página sobre nós.',
    },
    "/produtos": {
        title: 'Produtos',
        route: '/produtos',
        description: 'Página de produtos.',
    },

    "/pessoas": {
        redirect: '/pessoas/listar',
    }, "/pessoas/": {redirect: '/pessoas/listar'},
    "/pessoas/listar": {
        title: 'Listar pessoas',
        route: '/pessoas/listar',
        description: 'Página de listagem de pessoas.',
    },
    "/pessoas/criar": {
        title: 'Criar pessoa',
        route: '/pessoas/criar',
        description: 'Página de criação de pessoas.',
    }
}

// function that watches the url and changes the page accordingly by calling urlLocationHandler()
const navigateTo = (event) => {
    // event = event || window.event // get window.event if e argument missing (in IE)
    event.preventDefault()
    // prevent to load the same page
    if(event.target.getAttribute('href') == window.location.pathname) {
        return
    }
    window.history.pushState({}, '', event.target.getAttribute('href'))
    urlLocationHandler()
}

// function that handles the url and changes the view
const urlLocationHandler = async () => {
    // get the current url path, like '/home' or '/company/about'
    // it does not include the domain name, nor the query string (like '?foo=bar')
    const path = window.location.pathname
    path.length == 0 ? path = '/' : false
    console.log('path: ', path)

    // get the route object from the urlRoutes object
    const route = urlRoutes[path] || urlRoutes[404]
    if(route.redirect) {
        window.history.pushState({}, '', route.redirect)
        urlLocationHandler()
    } else if(route.template) {
        await fetch(`${route.template}`)
        .then(response => response.text())
        .then(data => {
            document.querySelector(main).innerHTML = data
        })
        console.log('route: ', route)
    } else (
        loadPage(route.route)
    )    

}

let currentLoadPageController = null
async function loadPage(path) {

    if(currentLoadPageController) {
        currentLoadPageController.abort()
    }

    const controller = new AbortController()
    const { signal } = controller

    const apiUrl = `http://localhost:8080/api.php`
    const url = `${apiUrl}${path}`
    let response = await fetch(url, { signal })
    response = await response.json()
    console.log('response: ', response)

    // let iframe = document.querySelector('iframe')
    // // fill the frame with the response
    // iframe.contentDocument.querySelector('html').innerHTML = response?.html
    // // fill the css with the response
    // iframe.contentDocument.querySelector('head').innerHTML += `<style>${response?.css}</style>`
    // // fill javascript with the response
    // let script = document.createElement('script')
    // script.type = 'module'
    // script.innerHTML = response?.js
    // iframe.contentDocument.querySelector('body').appendChild(script)

    document.querySelector(main).innerHTML = response?.html
    document.querySelector(main).innerHTML += `<style>${response?.css}</style>`
    let script = document.createElement('script')
    script.type = 'module'
    script.innerHTML = response?.js
    document.querySelector(main).appendChild(script)

    // get all the scripts from the response
    // make them into elements
    // and append them to the body
    const response_document = new DOMParser().parseFromString(response, 'text/html')
    const scripts = response_document.querySelectorAll('script')
    scripts.forEach(script => {
        const scriptElement = document.createElement('script')
        scriptElement.type = 'module'
        // get the script content
        scriptElement.innerHTML = script.innerHTML
        // append the script to the body
        document.querySelector('body').appendChild(scriptElement)
    })

    
    currentLoadPageController = controller


}


window.onpopstate = urlLocationHandler

window.route = navigateTo

urlLocationHandler()