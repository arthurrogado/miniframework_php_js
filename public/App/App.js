import urlRoutes from "../App/urlRoutes.js"

let main = 'main'

function makeObjectParams(params) {
    // this function receives a string params and returns an object
    let objectParams = {}
    params.split('&').forEach(param => {
        let [key, value] = param.split('=')
        objectParams[key] = value
    })
    return objectParams
}

function updatePath(path, params = null) {
    // params = makeUrlParams(params)
    // let origin = window.location.origin
    // let originalPathname = window.location.pathname
    // let pathname = originalPathname.endsWith('/') ? originalPathname.slice(0, -1) : originalPathname // if the pathname ends with '/', remove it

    // window.history.pushState({}, path, origin + pathname + '#' + path + params)
    window.history.pushState({}, '', path + params)
}

const navigateTo = (path, params = null) => {
    // If it is a window popstate event, get the path from the event
    if(path instanceof PopStateEvent) {
        path = window.location.pathname
    } else if(path == window.location.pathname) {
        return
    }
    // Transform params object into a string for url
    params = params ? makeUrlParams(params) : ''
    // Update the url
    updatePath(path, params)
    // Then calls the urlLocationHandler
    urlLocationHandler()
}

const urlLocationHandler = async () => {
    let path = window.location.pathname

    const route = urlRoutes[path] || urlRoutes[404]
    if(route.redirect) {
        window.history.pushState({}, '', route.redirect)
        navigateTo(route.redirect)
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

async function loadPage(path) {
    const controller = new AbortController()
    const { signal } = controller

    const apiUrl = `http://localhost:8080/api.php`
    const url = `${apiUrl}${path}`
    let response = await fetch(url, { signal })
    response = await response.json()
    console.log('response: ', response)

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
    
}

window.onpopstate = urlLocationHandler

window.route = navigateTo

urlLocationHandler()




import Info from "../App/components/InfoBox.js"

class HttpClient {

    constructor() {
        this.Info = Info
        this.navigateTo = navigateTo
    }

    makeRequest(url, method = 'GET', data = {}) {
        const options = {
            method,
            headers: {
                'Content-Type': 'application/json'
            }
        }

        if(method == 'POST') {
            let formdata = new FormData()
            for(let key in data) {
                formdata.append(key, data[key])
            }
            options.body = formdata
        }

        // tentar retornar a response em json, se não der certo, retorna em texto
        return fetch(url, options)
        .then(response => response.json())
        .catch(error => {
            console.log('error: ', error)
            return error
        })
    }

    alert(message) {
        alert(message)
    }
    
}



export default HttpClient;