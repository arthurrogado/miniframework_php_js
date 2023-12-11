# Miniframework php e javascript.

Este repositório guarda um projeto base para qualquer outro que utilize a linguagem php e javascript. É simples, mas robusto ao mesmo tempo, e permite (minimamente), uma organização e arquitetura de código, sem ser tão complexo como um framework de mercado. 

O objetivo é atender a necessidade de projetos pequenos e médios, que iniciantes possam desenvolver e entender o ambiente full-stack (front-end e back-end). Qualquer dúvida, entre em contato comigo (arthurrogado.t.me).

## Itens importantes:
- Back-end em PHP e Front-end em Javascript.
- Se trata de um SPA (Single Page Application), sendo uma aplicação de página única. A sua navegação não deve incluir reloads de página.
- O back-end é baseado em arquitetura MVC (Model, View, Controller). A convenção psr-4 está sendo utilizado para o autoload das classes.
- Gostar de programação (opcional).

Basicamente, o javascript faz as requisições http no arquivo public/api/index.php e o php faz o tratamento das requisições e retorna os dados em json.

## Fluxos de requisição:

### **Views**

Os controllers de páginas (_Pages_) então no namespace `App\Controllers\Pages`, e extendem a classe `MF\Controller\Action` que faz a renderização.

Por exemplo, o controller `App\Controllers\Pages\Usuarios` renderiza as views listar, criar e visualizar. 

A **RENDERIZAÇÃO** é feita retornando os dados dos arquivos html, css e javascript da pasta `App/Views/[nome_do_controller]/[nome_da_view]`. 
 
    Ou seja, o controller `App\Pages\Usuarios` renderiza a view _listar_ retornando os arquivos `/App/Views/Usuarios/listar/[html|css|js]`.

### **Controllers**

    Os controllers fazem o tratamento das requisições e retornam os dados em json. Eles estão no namespace `App\Controllers`. Os que estão em `App\Controllers\Pages` são os controllers de páginas, que fazem a renderização das views apenas. Estão ligados ao middleware de permissão de acesso, que verifica se o usuário está logado ou não e se tem determinados atributos; ainda não está implementado o middleware de permissão de acesso, apenas de condições.

### **Models**

    Os models estão no namespace `App\Models`. Eles fazem a conexão com o banco de dados e fazem as operações de CRUD (Create, Read, Update, Delete).

### **Middlewares**

    Os middlewares estão no namespace `App\Middlewares`. Eles fazem a verificação de condições, como se o usuário está logado ou não, se tem determinados atributos, etc. Eles são chamados antes de qualquer requisição, e podem ser chamados em qualquer controller para fazer a verificação de condições.

### **Api**

    A pasta `public/api` contém o arquivo `index.php`, que é o arquivo que recebe as requisições http do front-end. Ele faz o tratamento das requisições e executa o Router, que é o arquivo que faz o roteamento das requisições para os controllers. O roteador está no namespace `App\Route`, e ele faz o roteamento das requisições para os controllers, que estão no namespace `App\Controllers`. 

    O roteamento é feito através de uma array de rotas, que é passada para o construtor do Router. Cada rota é um array com os seguintes atributos:

    - **route**: A rota em si, que é uma string. Ex: '/usuarios/listar'.
    - **controller**: O controller que será chamado, que é uma string. Ex: 'Usuarios'.
    - **action**: A action do controller que será chamada, que é uma string. Ex: 'listar'.
    - **public**: Se a rota é pública ou não, que é um booleano. Ex: true, caso seja pública e não precise de autenticação para ser acessada, como a rota de login, por exemplo.


## Estrutura de pastas:

    - **App**: Contém os arquivos da aplicação.
        - **Controllers**: Contém os controllers da aplicação.
            - **Pages**: Contém os controllers de páginas da aplicação.
        - **Middlewares**: Contém os middlewares da aplicação.
        - **Models**: Contém os models da aplicação.
        - **Route**: Contém o arquivo de roteamento da aplicação.
        - **Views**: Contém as views da aplicação.
    - **Public**: Contém os arquivos públicos da aplicação.
        - **Api**: Contém o arquivo index.php, que recebe as requisições http do front-end.
        - **frontend**: Contém os arquivos estáticos da aplicação, como css, js, imagens, etc.
    - **Vendor**: Contém os arquivos de dependências da aplicação, como o autoload do composer.


## Utilização:

    Para demonstrar a utilização e implementação de novas funcionalidades, faremos um exemplo de uma aplicação de gerenciamento de usuários (que já está implementada).
    Seguiremos os seguintes passos:

    1. Criar o banco de dados.
        1.1. No caso é necessário criar e setar o banco, com as tabelas e determinadas colunas. Neste caso, o banco é o 'miniframework', a tabela é 'usuarios' e as colunas são 'id', 'nome', 'usuario' e 'senha'.