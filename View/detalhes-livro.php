<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Livro - BookManager</title>
    
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

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="meus-livros.php" class="text-decoration-none">Livros</a></li>
                <li class="breadcrumb-item active">Detalhes do Livro</li>
            </ol>
        </nav>

        <!-- Book Details -->
        <div id="livroDetalhes">
            <!-- Conteúdo será carregado via JavaScript -->
        </div>

        <!-- Loading State -->
        <div id="loadingState" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Carregando...</span>
            </div>
            <p class="mt-3 text-muted">Carregando detalhes do livro...</p>
        </div>

        <!-- Error State -->
        <div id="errorState" class="text-center py-5" style="display: none;">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
            <h3 class="mt-3">Livro não encontrado</h3>
            <p class="text-muted">O livro que você está procurando não foi encontrado.</p>
            <a href="meus-livros.php" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Voltar para Meus Livros
            </a>
        </div>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="../js/main.js"></script>
    
    <script>
        let livroAtual = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Verificar autenticação
            BookManager.redirecionarSeNaoAutenticado();
            
            // Carregar dados do usuário
            const usuario = JSON.parse(localStorage.getItem('usuario'));
            if (usuario) {
                document.getElementById('nomeUsuario').textContent = usuario.nome;
            }
            
            // Carregar detalhes do livro
            carregarDetalhesLivro();
        });

        function carregarDetalhesLivro() {
            const urlParams = new URLSearchParams(window.location.search);
            const livroId = parseInt(urlParams.get('id'));
            
            if (!livroId) {
                mostrarErro();
                return;
            }
            
            // Simular carregamento
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
                
                // Fechar modal
                bootstrap.Modal.getInstance(document.getElementById('confirmarExclusaoModal')).hide();
                
                // Mostrar sucesso e redirecionar
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

