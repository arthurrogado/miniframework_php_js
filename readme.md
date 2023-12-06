## Exemplo de uso do miniframework php e javascript.

### Itens importantes:
- Back-end em PHP e Front-end em Javascript.
- Se trata de um SPA (Single Page Application), sendo uma aplicação de página única. A sua navegação não deve incluir reloads de página.
- O back-end é baseado em arquitetura MVC (Model, View, Controller). A convenção psr-4 está sendo utilizado para o autoload das classes.

Basicamente, o javascript faz as requisições http no arquivo public/api/index.php e o php faz o tratamento das requisições e retorna os dados em json.

Dentro da pasta 