<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BookManager</title>
    
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
                        <a class="nav-link active" href="index.php?action=dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=my_books">
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
                            <i class="fas fa-user me-1"></i><?= htmlspecialchars($user_name ?? 'Usuário') ?>
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
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </h1>
                <p class="text-muted">Bem-vindo de volta, <?= htmlspecialchars($user_name ?? 'Usuário') ?>!</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-primary mb-2">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        <h4 class="card-title text-primary"><?= $stats['total_books'] ?? 0 ?></h4>
                        <p class="card-text text-muted">Total de Livros</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-success mb-2">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <h4 class="card-title text-success"><?= $stats['books_read'] ?? 0 ?></h4>
                        <p class="card-text text-muted">Livros Lidos</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-warning mb-2">
                            <i class="fas fa-book-reader fa-2x"></i>
                        </div>
                        <h4 class="card-title text-warning"><?= $stats['books_reading'] ?? 0 ?></h4>
                        <p class="card-text text-muted">Lendo Atualmente</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="text-info mb-2">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                        <h4 class="card-title text-info"><?= $stats['books_want_to_read'] ?? 0 ?></h4>
                        <p class="card-text text-muted">Desejo Ler</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clock me-2 text-primary"></i>Livros Recentes
                            </h5>
                            <a href="index.php?action=my_books" class="btn btn-outline-primary btn-sm">
                                Ver Todos
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($recent_books)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Título</th>
                                            <th>Autor</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recent_books as $book): ?>
                                            <tr>
                                                <td class="fw-bold"><?= htmlspecialchars($book['title']) ?></td>
                                                <td><?= htmlspecialchars($book['author']) ?></td>
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
                                                <td>
                                                    <a href="index.php?action=book_details&id=<?= $book['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Nenhum livro cadastrado ainda.</p>
                                <a href="index.php?action=add_book" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Adicionar Primeiro Livro
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-tags me-2 text-primary"></i>Gêneros Favoritos
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($books_by_genre)): ?>
                            <?php foreach (array_slice($books_by_genre, 0, 5) as $genre): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span><?= htmlspecialchars($genre['genre']) ?></span>
                                    <span class="badge bg-primary"><?= $genre['count'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted text-center">Nenhum gênero cadastrado ainda.</p>
                        <?php endif; ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>