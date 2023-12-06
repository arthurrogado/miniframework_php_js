import HttpClient from "/frontend/App.js";

const httpClient = new HttpClient();

// Atualizar sidebar

function returnNavItem( href, nome, icon = 'fa-solid fa-folder') {
    let div = document.createElement('div')
    div.classList.add('nav-item')
    div.innerHTML = `
        <i class="fa ${icon}"></i>
        <span>${nome}</span>
    `
    div.addEventListener('click', () => {
        httpClient.navigateTo(href)
    })
    return div
}

function popularMenuItems(items){
    let navigation = document.querySelector('#content nav');
    if(!navigation) return;

    navigation.innerHTML = '';
    items.forEach(item => {
        let nav_item = returnNavItem(item[0], item[1], item[2]);
        navigation.appendChild(nav_item);
    });
}

function atualizarSidebar(){
    // verificar se logado
    httpClient.makeRequest('/api/usuario/check_login')
    .then(response => {

        console.log('~~ RESPOSTA ATUALIZAR SIDEBAR | check_login')
        console.log(response)

        if(response.ok){ // LOGADO
            let usuario = response.usuario
            document.querySelector('nav').classList.add('active')
            document.querySelector('nav').classList.remove('hidden')
            
            let itens = [];
            
            if(usuario.id == 1){ // ADMIN
                itens = [
                    ['/configuracoes', 'Configurações', 'fa-cog'],
                ];

                // Usuário comum
            } else {
                itens = [
                    ['/home', 'Home', 'fa-solid fa-home'],
                ]
            }

            // Nesse exemplo de uso é possível determinar diferentes menus baseados no usuário
            
            // popularMenuItems(itens)

            popularMenuItems([
                ['/home', 'Home', 'fa-home'],
                ['/sobre_nos', 'Sobre Nós', 'fa-info-circle'],
                ['/contato', 'Contato', 'fa-envelope'],
                ['/produtos', 'Produtos', 'fa-th'],
                ['/pessoas/listar', 'Pessoas', 'fa-users'],
                ['/pessoas/criar', 'Criar Pessoa', 'fa-user-plus'],
                ['/login', 'Login', 'fa-sign-in'],
                ['/logout', 'Logout', 'fa-sign-out'],
            ])
            
        }

        else { // NÃO LOGADO
            // Esconder sidebar
            let sidebar = document.querySelector('#content nav')
            sidebar.innerHTML = ''
            sidebar.classList.remove('active')
        }

    })
}

export default atualizarSidebar;