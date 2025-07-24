<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro - BookManager</title>
    
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-edit me-2 text-primary"></i>Editar Livro
                        </h4>
                    </div>
                    <div class="card-body">
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

                        <form method="POST" action="index.php?action=do_edit_book" novalidate>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']) ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">
                                        <i class="fas fa-book me-2"></i>Título *
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title" required 
                                           placeholder="Digite o título do livro" value="<?= htmlspecialchars($book['title']) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="author" class="form-label">
                                        <i class="fas fa-user-edit me-2"></i>Autor *
                                    </label>
                                    <input type="text" class="form-control" id="author" name="author" required 
                                           placeholder="Digite o nome do autor" value="<?= htmlspecialchars($book['author']) ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="genre" class="form-label">
                                        <i class="fas fa-tags me-2"></i>Gênero *
                                    </label>
                                    <input type="text" class="form-control" id="genre" name="genre" required 
                                           placeholder="Digite o gênero do livro" value="<?= htmlspecialchars($book['genre']) ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">
                                        <i class="fas fa-bookmark me-2"></i>Status
                                    </label>
                                    <select class="form-select" id="status" name="status">
                                        <?php foreach ($valid_statuses as $status_option): ?>
                                            <option value="<?= htmlspecialchars($status_option) ?>" 
                                                    <?= ($book['status'] === $status_option) ? 'selected' : '' ?>>
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
                                           placeholder="Digite a editora" value="<?= htmlspecialchars($book['publisher'] ?? '') ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="year_public" class="form-label">
                                        <i class="fas fa-calendar-alt me-2"></i>Ano de Publicação
                                    </label>
                                    <input type="number" class="form-control" id="year_public" name="year_public" 
                                           placeholder="Ex: 2023" min="1000" max="<?= date('Y') ?>" 
                                           value="<?= htmlspecialchars($book['year_public'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="isbn" class="form-label">
                                    <i class="fas fa-barcode me-2"></i>ISBN
                                </label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       placeholder="Digite o ISBN do livro" value="<?= htmlspecialchars($book['isbn'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-2"></i>Descrição
                                </label>
                                <textarea class="form-control" id="description" name="description" rows="4" 
                                          placeholder="Digite uma descrição do livro (opcional)"><?= htmlspecialchars($book['description'] ?? '') ?></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Salvar Alterações
                                </button>
                                <a href="index.php?action=my_books" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                                <a href="index.php?action=book_details&id=<?= $book['id'] ?>" class="btn btn-outline-info">
                                    <i class="fas fa-eye me-2"></i>Ver Detalhes
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
