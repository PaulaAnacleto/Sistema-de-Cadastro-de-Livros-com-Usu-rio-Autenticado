// ===== DADOS SIMULADOS =====
let livrosSimulados = [
    {
        id: 1,
        titulo: "Dom Casmurro",
        autor: "Machado de Assis",
        isbn: "978-85-359-0277-5",
        editora: "Companhia das Letras",
        ano: 1899,
        genero: "Literatura Brasileira",
        descricao: "Romance clássico da literatura brasileira que narra a história de Bentinho e Capitu.",
        status: "Disponível"
    },
    {
        id: 2,
        titulo: "1984",
        autor: "George Orwell",
        isbn: "978-85-250-4682-1",
        editora: "Companhia das Letras",
        ano: 1949,
        genero: "Ficção Científica",
        descricao: "Distopia sobre um regime totalitário que controla todos os aspectos da vida.",
        status: "Disponível"
    },
    {
        id: 3,
        titulo: "O Pequeno Príncipe",
        autor: "Antoine de Saint-Exupéry",
        isbn: "978-85-359-0811-1",
        editora: "Agir",
        ano: 1943,
        genero: "Literatura Infantil",
        descricao: "Fábula poética sobre amizade, amor e perda narrada por um piloto perdido no deserto.",
        status: "Emprestado"
    }
];

let usuarioLogado = null;

// ===== UTILITÁRIOS =====
function mostrarLoading(elemento) {
    elemento.innerHTML = '<span class="loading-spinner me-2"></span>Carregando...';
    elemento.disabled = true;
}

function esconderLoading(elemento, textoOriginal) {
    elemento.innerHTML = textoOriginal;
    elemento.disabled = false;
}

function mostrarAlerta(tipo, mensagem, container = 'alertContainer') {
    const alertContainer = document.getElementById(container);
    if (!alertContainer) return;

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${tipo} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    alertContainer.appendChild(alertDiv);
    
    // Remove o alerta após 5 segundos
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validarSenha(senha) {
    // Mínimo 8 caracteres, pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 caractere especial
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regex.test(senha);
}

function validarISBN(isbn) {
    // Remove hífens e espaços
    const cleanISBN = isbn.replace(/[-\s]/g, '');
    // Verifica se tem 10 ou 13 dígitos
    return /^\d{10}$/.test(cleanISBN) || /^\d{13}$/.test(cleanISBN);
}

// ===== SIMULAÇÃO DE REQUISIÇÕES HTTP =====
function simularRequisicaoHTTP(metodo, url, dados = null) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            console.log(`${metodo} ${url}`, dados);
            
            switch (url) {
                case '/api/login':
                    if (dados.email === 'usuario@teste.com' && dados.senha === 'Teste123!') {
                        usuarioLogado = {
                            id: 1,
                            nome: 'Usuário Teste',
                            email: dados.email
                        };
                        resolve({ sucesso: true, usuario: usuarioLogado });
                    } else {
                        reject({ erro: 'Credenciais inválidas' });
                    }
                    break;
                    
                case '/api/usuarios':
                    resolve({ sucesso: true, mensagem: 'Usuário cadastrado com sucesso!' });
                    break;
                    
                case '/api/livros':
                    if (metodo === 'GET') {
                        resolve({ sucesso: true, livros: livrosSimulados });
                    } else if (metodo === 'POST') {
                        const novoLivro = {
                            id: livrosSimulados.length + 1,
                            ...dados
                        };
                        livrosSimulados.push(novoLivro);
                        resolve({ sucesso: true, livro: novoLivro });
                    }
                    break;
                    
                case `/api/livros/${dados.id}`:
                    if (metodo === 'PUT') {
                        const index = livrosSimulados.findIndex(l => l.id === dados.id);
                        if (index !== -1) {
                            livrosSimulados[index] = { ...livrosSimulados[index], ...dados };
                            resolve({ sucesso: true, livro: livrosSimulados[index] });
                        } else {
                            reject({ erro: 'Livro não encontrado' });
                        }
                    } else if (metodo === 'DELETE') {
                        const index = livrosSimulados.findIndex(l => l.id === dados.id);
                        if (index !== -1) {
                            livrosSimulados.splice(index, 1);
                            resolve({ sucesso: true });
                        } else {
                            reject({ erro: 'Livro não encontrado' });
                        }
                    }
                    break;
                    
                default:
                    resolve({ sucesso: true });
            }
        }, 1000 + Math.random() * 1000); // Simula latência de 1-2 segundos
    });
}

// ===== VALIDAÇÃO DE FORMULÁRIOS EM TEMPO REAL =====
function adicionarValidacaoTempoReal(formulario) {
    const campos = formulario.querySelectorAll('input, select, textarea');
    
    campos.forEach(campo => {
        campo.addEventListener('blur', () => validarCampo(campo));
        campo.addEventListener('input', () => {
            if (campo.classList.contains('is-invalid') || campo.classList.contains('is-valid')) {
                validarCampo(campo);
            }
        });
    });
}

function validarCampo(campo) {
    const valor = campo.value.trim();
    let valido = true;
    let mensagem = '';
    
    // Remove classes anteriores
    campo.classList.remove('is-valid', 'is-invalid');
    
    // Validação de campo obrigatório
    if (campo.hasAttribute('required') && !valor) {
        valido = false;
        mensagem = 'Este campo é obrigatório.';
    }
    
    // Validações específicas por tipo
    if (valor && valido) {
        switch (campo.type) {
            case 'email':
                if (!validarEmail(valor)) {
                    valido = false;
                    mensagem = 'Por favor, insira um e-mail válido.';
                }
                break;
                
            case 'password':
                if (campo.name === 'senha' && !validarSenha(valor)) {
                    valido = false;
                    mensagem = 'A senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula, número e caractere especial.';
                }
                break;
                
            case 'number':
                const numero = parseInt(valor);
                if (isNaN(numero) || numero < 1) {
                    valido = false;
                    mensagem = 'Por favor, insira um número válido.';
                }
                break;
        }
        
        // Validação de ISBN
        if (campo.name === 'isbn' && !validarISBN(valor)) {
            valido = false;
            mensagem = 'Por favor, insira um ISBN válido (10 ou 13 dígitos).';
        }
        
        // Validação de confirmação de senha
        if (campo.name === 'confirmarSenha') {
            const senhaOriginal = document.querySelector('input[name="senha"]');
            if (senhaOriginal && valor !== senhaOriginal.value) {
                valido = false;
                mensagem = 'As senhas não coincidem.';
            }
        }
    }
    
    // Aplica a classe e mensagem apropriada
    campo.classList.add(valido ? 'is-valid' : 'is-invalid');
    
    // Atualiza a mensagem de feedback
    let feedbackElement = campo.parentNode.querySelector('.invalid-feedback, .valid-feedback');
    if (!feedbackElement) {
        feedbackElement = document.createElement('div');
        campo.parentNode.appendChild(feedbackElement);
    }
    
    feedbackElement.className = valido ? 'valid-feedback' : 'invalid-feedback';
    feedbackElement.textContent = valido ? 'Campo válido!' : mensagem;
    
    return valido;
}

function validarFormulario(formulario) {
    const campos = formulario.querySelectorAll('input, select, textarea');
    let formularioValido = true;
    
    campos.forEach(campo => {
        if (!validarCampo(campo)) {
            formularioValido = false;
        }
    });
    
    return formularioValido;
}

// ===== NAVEGAÇÃO E ESTADO DA APLICAÇÃO =====
function verificarAutenticacao() {
    // Simula verificação de token/sessão
    const token = localStorage.getItem('authToken');
    if (token) {
        usuarioLogado = JSON.parse(localStorage.getItem('usuario'));
        return true;
    }
    return false;
}

function redirecionarSeNaoAutenticado() {
    if (!verificarAutenticacao()) {
        window.location.href = 'login.php';
    }
}

function logout() {
    localStorage.removeItem('authToken');
    localStorage.removeItem('usuario');
    usuarioLogado = null;
    window.location.href = 'index.php';
}

// ===== INICIALIZAÇÃO =====
document.addEventListener('DOMContentLoaded', function() {
    // Adiciona animações de entrada
    const elementos = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right');
    elementos.forEach(elemento => {
        elemento.style.opacity = '0';
        setTimeout(() => {
            elemento.style.opacity = '1';
        }, 100);
    });
    
    // Inicializa tooltips do Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Adiciona validação em tempo real a todos os formulários
    const formularios = document.querySelectorAll('form');
    formularios.forEach(formulario => {
        adicionarValidacaoTempoReal(formulario);
    });
});

// ===== EXPORTA FUNÇÕES PARA USO GLOBAL =====
window.BookManager = {
    simularRequisicaoHTTP,
    mostrarAlerta,
    validarFormulario,
    verificarAutenticacao,
    redirecionarSeNaoAutenticado,
    logout,
    mostrarLoading,
    esconderLoading,
    livrosSimulados,
    usuarioLogado
};

