<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookManager - Sistema de Cadastro de Livros</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html">
                <i class="fas fa-book-open me-2"></i>BookManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro-usuario.html">
                            <i class="fas fa-user-plus me-1"></i>Cadastrar-se
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold text-white mb-4">
                            Organize sua biblioteca com facilidade
                        </h1>
                        <p class="lead text-white-50 mb-4">
                            O BookManager é a solução perfeita para catalogar, organizar e gerenciar todos os seus livros em um só lugar. Interface moderna, intuitiva e totalmente responsiva.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="cadastro-usuario.html" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-rocket me-2"></i>Começar Agora
                            </a>
                            <a href="login.html" class="btn btn-outline-light btn-lg px-4">
                                <i class="fas fa-sign-in-alt me-2"></i>Fazer Login
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image text-center">
                        <i class="fas fa-books hero-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">Funcionalidades Principais</h2>
                    <p class="lead text-muted">Tudo que você precisa para gerenciar sua biblioteca</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <h4 class="fw-bold text-primary">Cadastro Fácil</h4>
                        <p class="text-muted">Adicione livros rapidamente com formulários intuitivos e validação em tempo real.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4 class="fw-bold text-primary">Busca Avançada</h4>
                        <p class="text-muted">Encontre qualquer livro instantaneamente com filtros por título, autor, gênero e mais.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="fw-bold text-primary">Totalmente Responsivo</h4>
                        <p class="text-muted">Acesse sua biblioteca de qualquer dispositivo - desktop, tablet ou smartphone.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold">
                        <i class="fas fa-book-open me-2"></i>BookManager
                    </h5>
                    <p class="text-muted">Sistema moderno de gerenciamento de livros.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">
                        &copy; 2024 BookManager. Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="../js/main.js"></script>
</body>
</html>

