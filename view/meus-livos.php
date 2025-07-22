<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Livros - BookManager</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.html">
                <i class="fas fa-book-open me-2"></i>BookManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="meus-livros.html">
                            <i class="fas fa-books me-1"></i>Livros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro-livro.html">
                            <i class="fas fa-plus me-1"></i>Cadastrar Livro
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <span id="nomeUsuario">Usuário</span>
                        </a>
                        <ul class="dropdown-menu">
                          
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="BookManager.logout()"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-1">
                    <i class="fas fa-books me-2"></i>Biblioteca
                </h2>
                <p class="text-muted mb-0">Gerencie todos os seus livros em um só lugar</p>
            </div>
            <a href="cadastro-livro.html" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Adicionar Livro
            </a>
        </div>

        <!-- Filters and Search -->
        <div class="card border-0 mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="buscarTitulo" class="form-label fw-bold">
                            <i class="fas fa-search me-2"></i>Buscar por Título
                        </label>
                        <input type="text" class="form-control" id="buscarTitulo" 
                               placeholder="Digite o título do livro">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroAutor" class="form-label fw-bold">
                            <i class="fas fa-user me-2"></i>Filtrar por Autor
                        </label>
                        <input type="text" class="form-control" id="filtroAutor" 
                               placeholder="Digite o nome do autor">
                    </div>
                    <div class="col-md-3">
                        <label for="filtroGenero" class="form-label fw-bold">
                            <i class="fas fa-tags me-2"></i>Filtrar por Gênero
                        </label>
                        <select class="form-select" id="filtroGenero">
                            <option value="">Todos os gêneros</option>
                            <option value="Literatura Brasileira">Literatura Brasileira</option>
                            <option value="Literatura Estrangeira">Literatura Estrangeira</option>
                            <option value="Ficção Científica">Ficção Científica</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Romance">Romance</option>
                            <option value="Mistério/Suspense">Mistério/Suspense</option>
                            <option value="Biografia">Biografia</option>
                            <option value="História">História</option>
                            <option value="Filosofia">Filosofia</option>
                            <option value="Autoajuda">Autoajuda</option>
                            <option value="Negócios">Negócios</option>
                            <option value="Tecnologia">Tecnologia</option>
                            <option value="Literatura Infantil">Literatura Infantil</option>
                            <option value="Literatura Juvenil">Literatura Juvenil</option>
                            <option value="Poesia">Poesia</option>
                            <option value="Teatro">Teatro</option>
                            <option value="Ensaio">Ensaio</option>
                            <option value="Crônica">Crônica</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filtroStatus" class="form-label fw-bold">
                            <i class="fas fa-info-circle me-2"></i>Status
                        </label>
                        <select class="form-select" id="filtroStatus">
                            <option value="">Todos</option>
                            <option value="Disponível">Disponível</option>

                            <option value="Emprestado">Emprestado</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button class="btn btn-outline-secondary me-2" onclick="limparFiltros()">
                            <i class="fas fa-eraser me-2"></i>Limpar Filtros
                        </button>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="visualizacao" id="visualizacaoCards" checked>
                            <label class="btn btn-outline-primary" for="visualizacaoCards">
                                <i class="fas fa-th-large me-1"></i>Cards
                            </label>
                            <input type="radio" class="btn-check" name="visualizacao" id="visualizacaoTabela">
                            <label class="btn btn-outline-primary" for="visualizacaoTabela">
                                <i class="fas fa-table me-1"></i>Tabela
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Info -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <span class="text-muted">
                    Mostrando <span id="resultadosInfo">0</span> livro(s)
                </span>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-sort me-2"></i>Ordenar por
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="ordenarPor('titulo')">Título</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordenarPor('autor')">Autor</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordenarPor('ano')">Ano</a></li>
                    <li><a class="dropdown-item" href="#" onclick="ordenarPor('genero')">Gênero</a></li>
                </ul>
            </div>
        </div>

        <!-- Books Container -->
        <div id="livrosContainer">
            <!-- Livros serão carregados via JavaScript -->
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="text-center py-5" style="display: none;">
            <i class="fas fa-book text-muted" style="font-size: 4rem;"></i>
            <h3 class="mt-3">Nenhum livro encontrado</h3>
            <p class="text-muted">Tente ajustar os filtros ou adicione novos livros à biblioteca.</p>
            <a href="cadastro-livro.html" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Adicionar Primeiro Livro
            </a>
        </div>

        <!-- Pagination -->
        <nav aria-label="Paginação" class="mt-4">
            <ul class="pagination justify-content-center" id="paginacao">
                <!-- Paginação será gerada via JavaScript -->
            </ul>
        </nav>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmarExclusaoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir o livro "<span id="tituloLivroExcluir"></span>"?</p>
                    <p class="text-muted">Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmarExclusao">
                        <i class="fas fa-trash me-2"></i>Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>

  <!-- Footer -->
<footer class="bg-dark text-light py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Coluna 1: Sobre -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-book-open me-2 text-primary"></i>BookManager
                    </h5>
                    <p class="text-muted mb-3">
                        Sistema completo de gerenciamento de biblioteca para empréstimo de livros. 
                        Organize, controle e gerencie sua biblioteca de forma moderna e eficiente.
                    </p>
                    <div class="social-links">
                        <a href="https://facebook.com/bookmanager" target="_blank" class="social-link me-3" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/bookmanager" target="_blank" class="social-link me-3" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com/bookmanager" target="_blank" class="social-link me-3" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://linkedin.com/company/bookmanager" target="_blank" class="social-link me-3" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://youtube.com/bookmanager" target="_blank" class="social-link me-3" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://github.com/bookmanager" target="_blank" class="social-link" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Coluna 2: Links Rápidos -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-section">
                    <h6 class="fw-bold mb-3">Links Rápidos</h6>
                    <ul class="footer-links">
                        <li><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="meus-livros.html">Biblioteca</a></li>
                        <li><a href="cadastro-livro.html">Cadastrar Livro</a></li>
                        <li><a href="#buscar">Buscar Livros</a></li>
                        <li><a href="#relatorios">Relatórios</a></li>
                    </ul>
                </div>
            </div>

            <!-- Coluna 3: Recursos -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-section">
                    <h6 class="fw-bold mb-3">Recursos</h6>
                    <ul class="footer-links">
                        <li><a href="#tutorial">Tutorial</a></li>
                        <li><a href="#documentacao">Documentação</a></li>
                        <li><a href="#api">API</a></li>
                        <li><a href="#integracao">Integrações</a></li>
                        <li><a href="#mobile">App Mobile</a></li>
                    </ul>
                </div>
            </div>

            <!-- Coluna 4: Suporte -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-section">
                    <h6 class="fw-bold mb-3">Suporte</h6>
                    <ul class="footer-links">
                        <li><a href="#ajuda">Central de Ajuda</a></li>
                        <li><a href="#contato">Contato</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#status">Status do Sistema</a></li>
                        <li><a href="#feedback">Feedback</a></li>
                    </ul>
                </div>
            </div>

            <!-- Coluna 5: Contato -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h6 class="fw-bold mb-3">Contato</h6>
                    <div class="contact-info">
                        <div class="contact-item mb-2">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <a href="mailto:contato@bookmanager.com">contato@bookmanager.com</a>
                        </div>
                        <div class="contact-item mb-2">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            <a href="tel:+5511999999999">(11) 99999-9999</a>
                        </div>
                        <div class="contact-item mb-3">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <span>São Paulo, SP - Brasil</span>
                        </div>
                    </div>
                    
                    <!-- Newsletter -->
                    <div class="newsletter">
                        <h6 class="fw-bold mb-2">Newsletter</h6>
                        <p class="text-muted small mb-2">Receba novidades e dicas</p>
                        <div class="input-group input-group-sm">
                            <input type="email" class="form-control" placeholder="Seu e-mail">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Linha divisória -->
        <hr class="my-4 border-secondary">

        <!-- Rodapé inferior -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="copyright">
                    <p class="mb-0 text-muted">
                        <i class="far fa-copyright me-1"></i>
                        <span id="currentYear">2024</span> BookManager. Todos os direitos reservados.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-bottom-links text-md-end">
                    <a href="#privacidade" class="text-muted me-3">Política de Privacidade</a>
                    <a href="#termos" class="text-muted me-3">Termos de Uso</a>
                    <a href="#cookies" class="text-muted">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="../js/main.js"></script>
    
    <script>
        let livrosFiltrados = [];
        let livroParaExcluir = null;
        let paginaAtual = 1;
        const itensPorPagina = 6;
        let ordenacaoAtual = 'titulo';
        let visualizacaoAtual = 'cards';

        document.addEventListener('DOMContentLoaded', function() {
            // Verificar autenticação
            BookManager.redirecionarSeNaoAutenticado();
            
            // Carregar dados do usuário
            const usuario = JSON.parse(localStorage.getItem('usuario'));
            if (usuario) {
                document.getElementById('nomeUsuario').textContent = usuario.nome;
            }
            
            // Configurar event listeners
            configurarEventListeners();
            
            // Carregar livros
            carregarLivros();
        });

        function configurarEventListeners() {
            // Filtros
            document.getElementById('buscarTitulo').addEventListener('input', aplicarFiltros);
            document.getElementById('filtroAutor').addEventListener('input', aplicarFiltros);
            document.getElementById('filtroGenero').addEventListener('change', aplicarFiltros);
            document.getElementById('filtroStatus').addEventListener('change', aplicarFiltros);
            
            // Visualização
            document.getElementById('visualizacaoCards').addEventListener('change', function() {
                if (this.checked) {
                    visualizacaoAtual = 'cards';
                    renderizarLivros();
                }
            });
            
            document.getElementById('visualizacaoTabela').addEventListener('change', function() {
                if (this.checked) {
                    visualizacaoAtual = 'tabela';
                    renderizarLivros();
                }
            });
        }

        function carregarLivros() {
            livrosFiltrados = [...BookManager.livrosSimulados];
            aplicarOrdenacao();
            renderizarLivros();
        }

        function aplicarFiltros() {
            const buscarTitulo = document.getElementById('buscarTitulo').value.toLowerCase();
            const filtroAutor = document.getElementById('filtroAutor').value.toLowerCase();
            const filtroGenero = document.getElementById('filtroGenero').value;
            const filtroStatus = document.getElementById('filtroStatus').value;
            
            livrosFiltrados = BookManager.livrosSimulados.filter(livro => {
                const matchTitulo = livro.titulo.toLowerCase().includes(buscarTitulo);
                const matchAutor = livro.autor.toLowerCase().includes(filtroAutor);
                const matchGenero = !filtroGenero || livro.genero === filtroGenero;
                const matchStatus = !filtroStatus || livro.status === filtroStatus;
                
                return matchTitulo && matchAutor && matchGenero && matchStatus;
            });
            
            paginaAtual = 1;
            aplicarOrdenacao();
            renderizarLivros();
        }

        function limparFiltros() {
            document.getElementById('buscarTitulo').value = '';
            document.getElementById('filtroAutor').value = '';
            document.getElementById('filtroGenero').value = '';
            document.getElementById('filtroStatus').value = '';
            carregarLivros();
        }

        function ordenarPor(campo) {
            ordenacaoAtual = campo;
            aplicarOrdenacao();
            renderizarLivros();
        }

        function aplicarOrdenacao() {
            livrosFiltrados.sort((a, b) => {
                const valorA = a[ordenacaoAtual];
                const valorB = b[ordenacaoAtual];
                
                if (typeof valorA === 'string') {
                    return valorA.localeCompare(valorB);
                }
                return valorA - valorB;
            });
        }

        function renderizarLivros() {
            const container = document.getElementById('livrosContainer');
            const emptyState = document.getElementById('emptyState');
            
            if (livrosFiltrados.length === 0) {
                container.style.display = 'none';
                emptyState.style.display = 'block';
                document.getElementById('resultadosInfo').textContent = '0';
                return;
            }
            
            container.style.display = 'block';
            emptyState.style.display = 'none';
            
            // Calcular paginação
            const inicio = (paginaAtual - 1) * itensPorPagina;
            const fim = inicio + itensPorPagina;
            const livrosPagina = livrosFiltrados.slice(inicio, fim);
            
            // Atualizar info de resultados
            document.getElementById('resultadosInfo').textContent = livrosFiltrados.length;
            
            if (visualizacaoAtual === 'cards') {
                renderizarCards(livrosPagina, container);
            } else {
                renderizarTabela(livrosPagina, container);
            }
            
            renderizarPaginacao();
        }

        function renderizarCards(livros, container) {
            container.innerHTML = `
                <div class="row g-4">
                    ${livros.map(livro => `
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 h-100 hover-scale">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title fw-bold text-primary mb-1">${livro.titulo}</h5>
                                            <p class="text-muted mb-2">${livro.autor}</p>
                                        </div>
                                        <span class="badge badge-${livro.status.toLowerCase().replace('í', 'i').replace('ã', 'a')}">${livro.status}</span>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted">
                                            <i class="fas fa-building me-1"></i>${livro.editora} • ${livro.ano}<br>
                                            <i class="fas fa-tags me-1"></i>${livro.genero}
                                        </small>
                                    </div>
                                    <p class="card-text text-muted small">${livro.descricao.substring(0, 100)}${livro.descricao.length > 100 ? '...' : ''}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <div class="d-flex gap-2">
                                        <a href="detalhes-livro.html?id=${livro.id}" class="btn btn-sm btn-outline-primary flex-fill">
                                            <i class="fas fa-eye me-1"></i>Ver
                                        </a>
                                        <a href="editar-livro.html?id=${livro.id}" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" onclick="confirmarExclusao(${livro.id}, '${livro.titulo}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        function renderizarTabela(livros, container) {
            container.innerHTML = `
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Editora</th>
                                <th>Ano</th>
                                <th>Gênero</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${livros.map(livro => `
                                <tr>
                                    <td class="fw-bold">${livro.titulo}</td>
                                    <td>${livro.autor}</td>
                                    <td>${livro.editora}</td>
                                    <td>${livro.ano}</td>
                                    <td>${livro.genero}</td>
                                    <td>
                                        <span class="badge badge-${livro.status.toLowerCase().replace('í', 'i').replace('ã', 'a')}">${livro.status}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="detalhes-livro.html?id=${livro.id}" class="btn btn-outline-primary" title="Ver detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="editar-livro.html?id=${livro.id}" class="btn btn-outline-success" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-outline-danger" onclick="confirmarExclusao(${livro.id}, '${livro.titulo}')" title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `;
        }

        function renderizarPaginacao() {
            const totalPaginas = Math.ceil(livrosFiltrados.length / itensPorPagina);
            const paginacao = document.getElementById('paginacao');
            
            if (totalPaginas <= 1) {
                paginacao.innerHTML = '';
                return;
            }
            
            let html = '';
            
            // Botão anterior
            html += `
                <li class="page-item ${paginaAtual === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="irParaPagina(${paginaAtual - 1})">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            `;
            
            // Páginas
            for (let i = 1; i <= totalPaginas; i++) {
                html += `
                    <li class="page-item ${i === paginaAtual ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="irParaPagina(${i})">${i}</a>
                    </li>
                `;
            }
            
            // Botão próximo
            html += `
                <li class="page-item ${paginaAtual === totalPaginas ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="irParaPagina(${paginaAtual + 1})">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            `;
            
            paginacao.innerHTML = html;
        }

        function irParaPagina(pagina) {
            const totalPaginas = Math.ceil(livrosFiltrados.length / itensPorPagina);
            if (pagina >= 1 && pagina <= totalPaginas) {
                paginaAtual = pagina;
                renderizarLivros();
            }
        }

        function confirmarExclusao(id, titulo) {
            livroParaExcluir = id;
            document.getElementById('tituloLivroExcluir').textContent = titulo;
            const modal = new bootstrap.Modal(document.getElementById('confirmarExclusaoModal'));
            modal.show();
        }

        document.getElementById('btnConfirmarExclusao').addEventListener('click', async function() {
            const btn = this;
            const textoOriginal = btn.innerHTML;
            
            BookManager.mostrarLoading(btn);
            
            try {
                await BookManager.simularRequisicaoHTTP('DELETE', `/api/livros/${livroParaExcluir}`, { id: livroParaExcluir });
                
                // Fechar modal
                bootstrap.Modal.getInstance(document.getElementById('confirmarExclusaoModal')).hide();
                
                // Recarregar livros
                carregarLivros();
                
                alert('Livro excluído com sucesso!');
                
            } catch (error) {
                alert('Erro ao excluir livro: ' + (error.erro || 'Erro desconhecido'));
                BookManager.esconderLoading(btn, textoOriginal);
            }
        });
    </script>
</body>
</html>

