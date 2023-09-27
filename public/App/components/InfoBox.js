class Info {

    constructor(parent = 'body', msg = 'Example with class') {
        // Cria o elemento <style> e define seu conteúdo como o código CSS.
        let style = document.createElement('style');

        let _info = `
            background: #ffb1ab;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
        `

        // style.textContent = `
        //     .info {
        //         background-color: #ffb1ab;
        //         color: white;
        //         padding: 15px;
        //         margin-bottom: 20px;
        //         border-radius: 5px;
        //         border: 1px solid #9e271e;
        //         display: flex;
        //         justify-content: space-between;
        //     }
        // `;

        // Cria o elemento <div> e adiciona a classe 'info'.
        let info = document.createElement('div');
        info.classList.add('info');
        info.style.cssText = _info;

        // Define o conteúdo do elemento <div>.
        let msgSpan = document.createElement('span');
        msgSpan.textContent = msg;
        info.appendChild(msgSpan);

        // Cria o botão 'X'.
        let close = document.createElement('button');
        close.setAttribute('class', 'close');
        close.innerHTML = 'X';

        // Adiciona um ouvinte de evento para ocultar o elemento <div> quando o botão 'X' for clicado.
        close.addEventListener('click', () => {
            info.style.display = 'none';
        });

        // Anexa o botão ao elemento <div>.
        info.appendChild(close);

        // Anexa o elemento <style> ao cabeçalho (tag <head>) do documento.
        document.head.appendChild(style);

        // Anexa o elemento <div> ao elemento pai especificado.
        document.querySelector(parent).appendChild(info);
    }
}

export default Info;
