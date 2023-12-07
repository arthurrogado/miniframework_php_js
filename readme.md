# Exemplo de uso do miniframework php e javascript.

## Itens importantes:
- Back-end em PHP e Front-end em Javascript.
- Se trata de um SPA (Single Page Application), sendo uma aplicação de página única. A sua navegação não deve incluir reloads de página.
- O back-end é baseado em arquitetura MVC (Model, View, Controller). A convenção psr-4 está sendo utilizado para o autoload das classes.

Basicamente, o javascript faz as requisições http no arquivo public/api/index.php e o php faz o tratamento das requisições e retorna os dados em json.

## Fluxos de requisição:

### **Views**

Os controllers de páginas (_Pages_) então no namespace `App\Controllers\Pages`, e extendem a classe `MF\Controller\Action` que faz a renderização.

Por exemplo, o controller `App\Controllers\Pages\Usuarios` renderiza as views listar, criar e visualizar. 

A **RENDERIZAÇÃO** é feita retornando os dados dos arquivos html, css e javascript da pasta `App/Views/[nome_do_controller]/[nome_da_view]`. 
 
    Ou seja, o controller `App\Pages\Usuarios` renderiza a view _listar_ retornando os arquivos `/App/Views/Usuarios/listar/[html|css|js]`.

