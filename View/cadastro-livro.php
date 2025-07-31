<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - BookManager</title>
    
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
                        <a class="nav-link" href="index.php?action=my_books">
                            <i class="fas fa-book me-1"></i>Meus Livros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?action=add_book">
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus me-2 text-primary"></i>Cadastrar Novo Livro
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Alertas de sucesso e de erro -->
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

                        <form method="POST" action="index.php?action=do_add_book" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">
                                        <i class="fas fa-book me-2"></i>Título *
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title" required 
                                           placeholder="Digite o título do livro" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="author" class="form-label">
                                        <i class="fas fa-user-edit me-2"></i>Autor *
                                    </label>
                                    <!-- Preenchimento dos campos do formulário com valores enviados anteriormente:
                                    O valor preenchido será enviado junto ao formulário para cadastro.
                                    -->
                                    <input type="text" class="form-control" id="author" name="author" required 
                                           placeholder="Digite o nome do autor" value="<?= htmlspecialchars($_POST['author'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="genre" class="form-label">
                                        <i class="fas fa-tags me-2"></i>Gênero *
                                    </label>
                                    <input type="text" class="form-control" id="genre" name="genre" required 
                                           placeholder="Digite o gênero do livro" value="<?= htmlspecialchars($_POST['genre'] ?? '') ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">
                                        <i class="fas fa-bookmark me-2"></i>Status
                                    </label>
                                    <select class="form-select" id="status" name="status">
  <option value="" disabled <?= empty($_POST['status']) ? 'selected' : '' ?>>
    selecione o status 
  </option>
  <?php foreach ($valid_statuses as $status_option): ?>
    <option
      value="<?= htmlspecialchars($status_option, ENT_QUOTES) ?>"
      <?= (($_POST['status'] ?? '') === $status_option) ? 'selected' : '' ?>
    >
      <?= htmlspecialchars($status_option) ?>
    </option>
  <?php endforeach; ?>
</select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="publisher" class="form-label">
                                        <i class="fas fa-building me-2"></i>Editora
                                    </label>
                                    <input type="text" class="form-control" id="publisher" name="publisher" 
                                           placeholder="Digite a editora" value="<?= htmlspecialchars($_POST['publisher'] ?? '') ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="year_public" class="form-label">
                                        <i class="fas fa-calendar-alt me-2"></i>Ano de Publicação
                                    </label>
                                    <input type="number" class="form-control" id="year_public" name="year_public" 
                                           placeholder="Ex: 2023" min="1000" max="<?= date('Y') ?>" 
                                           value="<?= htmlspecialchars($_POST['year_public'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="isbn" class="form-label">
                                    <i class="fas fa-barcode me-2"></i>ISBN
                                </label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       placeholder="Digite o ISBN do livro" value="<?= htmlspecialchars($_POST['isbn'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-2"></i>Descrição
                                </label>
                                <textarea class="form-control" id="description" name="description" rows="4" 
                                          placeholder="Digite uma descrição do livro (opcional)"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Cadastrar Livro
                                </button>
                                <a href="index.php?action=my_books" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                            </div>
                        </form>
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