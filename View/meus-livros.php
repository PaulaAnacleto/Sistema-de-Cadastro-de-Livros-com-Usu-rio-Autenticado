<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Livros - BookManager</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="templates/assets/css/style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?action=dashboard">
                <i class="fas fa-book-open me-2"></i>BookManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=my_books">
                            <i class="fas fa-book me-1"></i>Meus Livros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=add_book">
                            <i class="fas fa-plus me-1"></i>Adicionar Livro
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>Usuário
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?action=logout">
                                <i class="fas fa-sign-out-alt me-2"></i>Sair
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <?php if (isset($error) && $error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($success) && $success): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= htmlspecialchars($success) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 text-primary fw-bold">
                    <i class="fas fa-book me-2"></i>Meus Livros
                </h1>
                <p class="text-muted">Gerencie sua biblioteca pessoal</p>
            </div>
            <div class="col-auto">
                <a href="index.php?action=add_book" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Adicionar Livro
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="index.php" class="row g-3">
                    <input type="hidden" name="action" value="my_books">
                    
                    <div class="col-md-4">
                        <label for="search" class="form-label">Buscar</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="Título, autor, gênero..." value="<?= htmlspecialchars($search_term ?? '') ?>">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos os status</option>
                            <?php foreach ($valid_statuses as $status_option): ?>
                                <option value="<?= htmlspecialchars($status_option) ?>" 
                                        <?= (($current_status ?? '') === $status_option) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($status_option) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-outline-primary me-2">
                            <i class="fas fa-search me-1"></i>Filtrar
                        </button>
                        <a href="index.php?action=my_books" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Limpar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <?php if (!empty($books)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Gênero</th>
                                    <th>Status</th>
                                    <th>Ano</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($books as $book): ?>
                                    <tr>
                                        <td class="fw-bold"><?= htmlspecialchars($book['title']) ?></td>
                                        <td><?= htmlspecialchars($book['author']) ?></td>
                                        <td><?= htmlspecialchars($book['genre']) ?></td>
                                        <td>
                                            <?php
                                            $statusClass = [
                                                'Lido' => 'success',
                                                'Lendo' => 'warning',
                                                'Desejo Ler' => 'info',
                                                'Abandonado' => 'secondary'
                                            ];
                                            $class = $statusClass[$book['status']] ?? 'secondary';
                                            ?>
                                            <span class="badge bg-<?= $class ?>"><?= htmlspecialchars($book['status']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($book['year_public'] ?? '-') ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="index.php?action=book_details&id=<?= $book['id'] ?>" 
                                                   class="btn btn-sm btn-outline-primary" title="Ver detalhes">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="index.php?action=edit_book&id=<?= $book['id'] ?>" 
                                                   class="btn btn-sm btn-outline-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        title="Excluir" onclick="confirmDelete(<?= $book['id'] ?>, '<?= htmlspecialchars($book['title']) ?>')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-book fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Nenhum livro encontrado</h5>
                        <p class="text-muted">
                            <?php if (!empty($search_term) || !empty($current_status)): ?>
                                Tente ajustar os filtros de busca.
                            <?php else: ?>
                                Comece adicionando seu primeiro livro à biblioteca.
                            <?php endif; ?>
                        </p>
                        <a href="index.php?action=add_book" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Adicionar Livro
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir o livro <strong id="bookTitle"></strong>?</p>
                    <p class="text-muted">Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="POST" action="index.php?action=delete_book" style="display: inline;">
                        <input type="hidden" name="id" id="bookIdToDelete">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Excluir
                        </button>
                    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function confirmDelete(bookId, bookTitle) {
            document.getElementById('bookIdToDelete').value = bookId;
            document.getElementById('bookTitle').textContent = bookTitle;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</body>
</html>

