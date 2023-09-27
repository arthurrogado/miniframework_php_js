class HttpClient {

    constructor() {}

    makeRequest(url, method = 'GET', data = {}) {
        const options = {
            method,
            headers: {
                'Content-Type': 'application/json'
            }
        }

        if(method == 'POST') {
            options.body = JSON.stringify(data)
        }

        return fetch(url, options)
        .then(response => response.json())
    }

    alert(message) {
        alert(message)
    }
    
}



export default HttpClient;