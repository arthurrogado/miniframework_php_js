

let botao = document.querySelector('#alertar')
botao?.addEventListener('click', () => alert('Alerta funfou'))

import HttpClient from '/App/App.js'

import Info from '/App/components/InfoBox.js'
new Info('#info', 'Example with class')
new Info('#info', 'Example with class')
new Info('#info', 'Example with class')

import Botao from '/App/components/Botao.js'
Botao('#botao')
Botao('#botao')
Botao('#botao')
Botao('#botao')

let produtos = document.querySelector('#produtos')
console.log(produtos);
produtos?.addEventListener('click', (e) => {
    e.preventDefault();
    window.route(e)
});
