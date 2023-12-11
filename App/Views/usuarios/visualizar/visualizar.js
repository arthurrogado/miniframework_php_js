import HttpClient from "/frontend/App.js";
import Modal from "/frontend/components/Modal.js";
import Info from "/frontend/components/InfoBox.js";
const httpClient = new HttpClient();



class Visulizar {

    constructor() {
        this.httpClient = new HttpClient();
        this.preencher_detalhes_usuario();

        // Escutar eventos
        document.querySelector('#modalMudarSenha').addEventListener('click', (e) => {
            e.preventDefault();
            this.abrir_modal_mudar_senha();
        })

        document.querySelector('#btn_editar').addEventListener('click', (e) => {
            e.preventDefault();
            this.editar();
        })

    }

    preencher_detalhes_usuario() {
        // Preencher detalhes do usuário baseado na URL (?id=123)
        this.httpClient.makeRequest('/api/usuarios/visualizar', { id: this.httpClient.getParams().id })
            .then(response => {
                document.querySelector('#loadingVisualizarUsuario').remove();
                this.httpClient.fillAllInputs(response.usuario);
            })
    }
    
    editar() {
        // Salvar informações do formulário para restaurar caso o usuário cancele a edição
        this.dados_previos = new FormData(document.querySelector('#formVisualizarPessoa'))
        
        // Tornar todos os inputs editáveis
        this.httpClient.activateAllInputs()
        
        // Esconder botão editar e mostrar inserir os botões de salvar e cancelar
        document.querySelector('#btn_editar').classList.add('hidden')
        
        this.btn_salvar = document.createElement('button')
        this.btn_salvar.type = 'button'
        this.btn_salvar.classList.add('btn', 'btn-primary')
        this.btn_salvar.innerHTML = '<i class="fa fa-save"></i> Salvar'
        this.btn_salvar.addEventListener('click', _ => {
            this.salvar();
        })
        
        this.btn_cancelar = document.createElement('button')
        this.btn_cancelar.type = 'button'
        this.btn_cancelar.classList.add('btn', 'btn-danger')
        this.btn_cancelar.innerHTML = '<i class="fa fa-times"></i> Cancelar'
        this.btn_cancelar.addEventListener('click', _ => {
            this.cancelar();
        })
        
        // Inserir os botões ao lado do botão editar
        document.querySelector('#btn_editar').insertAdjacentElement('afterend', this.btn_salvar)
        document.querySelector('#btn_editar').insertAdjacentElement('afterend', this.btn_cancelar)
        
    }
    
    salvar() {
        // Salvar usuário
        let formdata = new FormData(document.querySelector('#formVisualizarPessoa'))
        formdata.append('id', this.httpClient.getParams().id)
        httpClient.makeRequest('/api/usuarios/editar', formdata)
        .then(response => {
            if (response.ok) {
                // atualizar a página para mostrar os dados atualizados
                httpClient.reloadPage()
            }
        })
    }
    
    cancelar() {
        // Mostrar botão editar e esconder botões salvar e cancelar, e tornar os inputs readonly novamente
        document.querySelector('#btn_editar').classList.remove('hidden')
        this.btn_salvar.remove()
        this.btn_cancelar.remove()
        httpClient.readOnlyAllInputs()
        // Preencher os inputs com os dados do usuário novamente
        document.querySelectorAll('#formVisualizarPessoa input').forEach(input => {
            input.value = this.dados_previos.get(input.name)
        })
    }

    abrir_modal_mudar_senha() {
        // abrir modal com formulário de nova senha e confirmação de senha
        this.modal_mudar_senha = new Modal('body', 'Mudar senha', /*html*/ `
            <form>
                <div class="input-field">
                    <input type="password" id="senha" name="senha" required>
                    <label for="senha">Nova senha</label>
                </div>
                <div class="input-field">
                    <input type="password" id="confirmacaoSenha" name="confirmacaoSenha" required>
                    <label for="confirmacaoSenha">Confirmação de senha</label>
                </div>
                <button class="btn btn-primary" type="button" id="mudarSenha">Salvar</button>
            </form>
        `);
        document.querySelector('#mudarSenha').addEventListener('click', (e) => {
            e.preventDefault();
            this.mudar_senha();
        })
    }
    
    mudar_senha() {
        let senha = document.querySelector('#senha').value
        let confirmacaoSenha = document.querySelector('#confirmacaoSenha').value
        
        if (senha.length < 3) {
            new Info('A senha deve ter pelo menos 3 caracteres', 'warning')
            return
        }

        if (senha != confirmacaoSenha) {
            new Info('As senhas não coincidem', 'warning')
            return
        }

        // Mudar senha
        httpClient.makeRequest('/api/usuarios/mudar_senha', {id: this.httpClient.getParams().id, senha: senha})
        .then(response => {
            if (response.ok) {
                this.modal_mudar_senha.close()
            }
        })

    }

}

new Visulizar();