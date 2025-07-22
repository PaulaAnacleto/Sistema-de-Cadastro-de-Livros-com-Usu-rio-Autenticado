
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BookManager</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="templates/assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navigation -->
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
                        <a class="nav-link active" href="dashboard.html">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="meus-livros.html">
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
        <!-- Welcome Section -->
        <div class="row mb-4 mt-4">
            <div class="col-12">
                <div class="card border-0 bg-gradient-primary text-white">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="fw-bold mb-2">
                                    <i class="fas fa-sun me-2"></i>
                                    Bem-vindo de volta, <span id="nomeUsuarioBemVindo">Usuário</span>!
                                </h2>
                                <p class="mb-0 opacity-75">
                                Gerencie sua biblioteca e descubra novos mundos através da leitura.                             </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-book-reader" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 h-100 hover-scale">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-books text-primary" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-1" id="totalLivros">0</h3>
                        <p class="text-muted mb-0">Total de Livros</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card border-0 h-100 hover-scale">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-handshake text-warning" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-warning mb-1" id="livrosEmprestados">0</h3>
                        <p class="text-muted mb-0">Emprestados</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 h-100 hover-scale">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-info" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold text-info mb-1" id="livrosDisponiveis">0</h3>
                        <p class="text-muted mb-0">Disponíveis</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Books and Quick Actions -->
        <div class="row g-4">
            <!-- Recent Books -->
            <div class="col-lg-8">
                <div class="card border-0 h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                Livros Recentes
                            </h5>
                            <a href="meus-livros.html" class="btn btn-sm btn-outline-primary">
                                Ver Todos
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="livrosRecentes">
                            <!-- Livros serão carregados via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="card border-0 h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-bolt me-2 text-primary"></i>
                            Ações Rápidas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="cadastro-livro.html" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Adicionar Novo Livro
                            </a>
                            <a href="meus-livros.html" class="btn btn-outline-primary">
                                <i class="fas fa-search me-2"></i>
                                Buscar Livros
                            </a>

                        </div>
                    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar autenticação
            BookManager.redirecionarSeNaoAutenticado();
            
            // Carregar dados do usuário
            const usuario = JSON.parse(localStorage.getItem('usuario'));
            if (usuario) {
                document.getElementById('nomeUsuario').textContent = usuario.nome;
                document.getElementById('nomeUsuarioBemVindo').textContent = usuario.nome;
            }
            
            // Carregar estatísticas
            carregarEstatisticas();
            
            // Carregar livros recentes
            carregarLivrosRecentes();
        });

        function carregarEstatisticas() {
            const livros = BookManager.livrosSimulados;
            
            document.getElementById('totalLivros').textContent = livros.length;
            document.getElementById('livrosEmprestados').textContent = livros.filter(l => l.status === 'Emprestado').length;
            document.getElementById('livrosDisponiveis').textContent = livros.filter(l => l.status === 'Disponível').length;
        }

        function carregarLivrosRecentes() {
            const livros = BookManager.livrosSimulados.slice(0, 3); // Últimos 3 livros
            const container = document.getElementById('livrosRecentes');
            
            if (livros.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-book text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">Nenhum livro cadastrado ainda.</p>
                        <a href="cadastro-livro.html" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Adicionar Primeiro Livro
                        </a>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = livros.map(livro => `
                <div class="d-flex align-items-center mb-3 p-3 bg-light rounded hover-shadow">
                    <div class="me-3">
                        <i class="fas fa-book text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1">${livro.titulo}</h6>
                        <p class="text-muted mb-1">${livro.autor}</p>
                        <span class="badge badge-${livro.status.toLowerCase().replace('í', 'i').replace('ã', 'a')}">${livro.status}</span>
                    </div>
                    <div>
                        <a href="detalhes-livro.html?id=${livro.id}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            `).join('');
        }

        function gerarRelatorio() {
            alert('Funcionalidade de relatório será implementada em breve!');
        }

        function exportarDados() {
            alert('Funcionalidade de exportação será implementada em breve!');
        }
    </script>

    <style>
        .progress-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: conic-gradient(var(--primary-color) 75%, #e9ecef 75%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .progress-circle-inner {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress-percentage {
            font-weight: bold;
            color: var(--primary-color);
        }

        .bg-gradient-primary {
            background: var(--gradient-primary) !important;
        }
    </style>
</body>
</html>

