<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Livro - BookManager</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../templates/assets/css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard.php">
                <i class="fas fa-book-open me-2"></i>BookManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="meus-livros.php">
                            <i class="fas fa-books me-1"></i>Livros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro-livro.php">
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

    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="meus-livros.php" class="text-decoration-none">Livros</a></li>
                <li class="breadcrumb-item active">Detalhes do Livro</li>
            </ol>
        </nav>

        <div id="livroDetalhes">
        </div>

        <div id="loadingState" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Carregando...</span>
            </div>
            <p class="mt-3 text-muted">Carregando detalhes do livro...</p>
        </div>

        <div id="errorState" class="text-center py-5" style="display: none;">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
            <h3 class="mt-3">Livro não encontrado</h3>
            <p class="text-muted">O livro que você está procurando não foi encontrado.</p>
            <a href="meus-livros.php" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Voltar para Meus Livros
            </a>
        </div>
    </div>

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
                    <p>Tem certeza que deseja excluir este livro?</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="../js/main.js"></script>
    
    <script>
        let livroAtual = null;

        document.addEventListener('DOMContentLoaded', function() {
            BookManager.redirecionarSeNaoAutenticado();
            
            const usuario = JSON.parse(localStorage.getItem('usuario'));
            if (usuario) {
                document.getElementById('nomeUsuario').textContent = usuario.nome;
            }

            carregarDetalhesLivro();
        });

        function carregarDetalhesLivro() {
            const urlParams = new URLSearchParams(window.location.search);
            const livroId = parseInt(urlParams.get('id'));
            
            if (!livroId) {
                mostrarErro();
                return;
            }
            
            setTimeout(() => {
                livroAtual = BookManager.livrosSimulados.find(l => l.id === livroId);
                
                if (!livroAtual) {
                    mostrarErro();
                    return;
                }
                
                mostrarDetalhes();
            }, 1000);
        }

        function mostrarDetalhes() {
            document.getElementById('loadingState').style.display = 'none';
            
            const container = document.getElementById('livroDetalhes');
            container.innerHTML = `
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="card border-0 h-100">
                            <div class="card-body text-center">
                                <div class="mb-4">
                                    <i class="fas fa-book text-primary" style="font-size: 6rem;"></i>
                                </div>
                                <span class="badge badge-${livroAtual.status.toLowerCase().replace('í', 'i').replace('ã', 'a')} fs-6 mb-3">
                                    ${livroAtual.status}
                                </span>
                                <div class="d-grid gap-2">
                                    <a href="editar-livro.php?id=${livroAtual.id}" class="btn btn-primary">
                                        <i class="fas fa-edit me-2"></i>Editar
                                    </a>
                                    <button class="btn btn-outline-danger" onclick="confirmarExclusao()">
                                        <i class="fas fa-trash me-2"></i>Excluir
                                    </button>
                                    <a href="meus-livros.php" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card border-0 h-100">
                            <div class="card-header bg-white border-0">
                                <h2 class="fw-bold text-primary mb-0">${livroAtual.titulo}</h2>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-user me-2"></i>Autor
                                            </label>
                                            <p class="detail-value">${livroAtual.autor}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-barcode me-2"></i>ISBN
                                            </label>
                                            <p class="detail-value">${livroAtual.isbn}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-building me-2"></i>Editora
                                            </label>
                                            <p class="detail-value">${livroAtual.editora}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-calendar me-2"></i>Ano de Publicação
                                            </label>
                                            <p class="detail-value">${livroAtual.ano}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-tags me-2"></i>Gênero
                                            </label>
                                            <p class="detail-value">${livroAtual.genero}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-info-circle me-2"></i>Status
                                            </label>
                                            <p class="detail-value">
                                                <span class="badge badge-${livroAtual.status.toLowerCase().replace('í', 'i').replace('ã', 'a')}">
                                                    ${livroAtual.status}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="detail-item">
                                            <label class="detail-label">
                                                <i class="fas fa-align-left me-2"></i>Descrição
                                            </label>
                                            <p class="detail-value">${livroAtual.descricao}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="meus-livros.php">Biblioteca</a></li>
                        <li><a href="cadastro-livro.php">Cadastrar Livro</a></li>
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
            `;
            
            container.style.display = 'block';
        }

        function mostrarErro() {
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('errorState').style.display = 'block';
        }

        function confirmarExclusao() {
            const modal = new bootstrap.Modal(document.getElementById('confirmarExclusaoModal'));
            modal.show();
        }

        document.getElementById('btnConfirmarExclusao').addEventListener('click', async function() {
            const btn = this;
            const textoOriginal = btn.innerHTML;
            
            BookManager.mostrarLoading(btn);
            
            try {
                await BookManager.simularRequisicaoHTTP('DELETE', `/api/livros/${livroAtual.id}`, { id: livroAtual.id });
                
                bootstrap.Modal.getInstance(document.getElementById('confirmarExclusaoModal')).hide();
                
                alert('Livro excluído com sucesso!');
                window.location.href = 'meus-livros.php';
                
            } catch (error) {
                alert('Erro ao excluir livro: ' + (error.erro || 'Erro desconhecido'));
                BookManager.esconderLoading(btn, textoOriginal);
            }
        });
    </script>

    <style>
        .detail-item {
            margin-bottom: 1rem;
        }

        .detail-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .detail-value {
            color: var(--dark-color);
            margin-bottom: 0;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .badge-disponivel {
            background: var(--gradient-success);
            color: white;
        }

        .badge-emprestado {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .badge-lendo {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }
    </style>
</body>
</html>

