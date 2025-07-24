<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Livro - BookManager</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="templates/assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navegação -->
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

    <!-- Conteúdo principal -->
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-book me-2 text-primary"></i>Detalhes do Livro
                            </h4>
                            <div class="btn-group">
                                <a href="index.php?action=edit_book&id=<?= $book['id'] ?>" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                                <a href="index.php?action=my_books" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Voltar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Informações principais -->
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h2 class="text-primary fw-bold mb-2"><?= htmlspecialchars($book['title']) ?></h2>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-user-edit me-2"></i>
                                        <strong>Autor:</strong> <?= htmlspecialchars($book['author']) ?>
                                    </p>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-tags me-2"></i>
                                        <strong>Gênero:</strong> <?= htmlspecialchars($book['genre']) ?>
                                    </p>
                                    <?php if (!empty($book['publisher'])): ?>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-building me-2"></i>
                                            <strong>Editora:</strong> <?= htmlspecialchars($book['publisher']) ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($book['year_public'])): ?>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            <strong>Ano de Publicação:</strong> <?= htmlspecialchars($book['year_public']) ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($book['isbn'])): ?>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-barcode me-2"></i>
                                            <strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($book['description'])): ?>
                                    <div class="mb-4">
                                        <h5 class="text-primary mb-3">
                                            <i class="fas fa-align-left me-2"></i>Descrição
                                        </h5>
                                        <p class="text-justify"><?= nl2br(htmlspecialchars($book['description'])) ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Status e informações adicionais -->
                            <div class="col-md-4">
                                <div class="card bg-light border-0">
                                    <div class="card-body text-center">
                                        <h6 class="card-title text-muted mb-3">Status de Leitura</h6>
                                        <?php
                                        $statusClass = [
                                            'Lido' => 'success',
                                            'Lendo' => 'warning',
                                            'Desejo Ler' => 'info',
                                            'Abandonado' => 'secondary'
                                        ];
                                        $statusIcon = [
                                            'Lido' => 'check-circle',
                                            'Lendo' => 'book-reader',
                                            'Desejo Ler' => 'heart',
                                            'Abandonado' => 'times-circle'
                                        ];
                                        $class = $statusClass[$book['status']] ?? 'secondary';
                                        $icon = $statusIcon[$book['status']] ?? 'question-circle';
                                        ?>
                                        <div class="mb-3">
                                            <i class="fas fa-<?= $icon ?> fa-3x text-<?= $class ?>"></i>
                                        </div>
                                        <span class="badge bg-<?= $class ?> fs-6 px-3 py-2">
                                            <?= htmlspecialchars($book['status']) ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="card bg-light border-0 mt-3">
                                    <div class="card-body">
                                        <h6 class="card-title text-muted mb-3">
                                            <i class="fas fa-info-circle me-2"></i>Informações
                                        </h6>
                                        <p class="small text-muted mb-2">
                                            <strong>Adicionado em:</strong><br>
                                            <?= date('d/m/Y H:i', strtotime($book['created_at'])) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ações -->
                        <div class="row mt-4">
                            <div class="col">
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="index.php?action=edit_book&id=<?= $book['id'] ?>" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Editar Livro
                                    </a>
                                    <button type="button" class="btn btn-danger" 
                                            onclick="confirmDelete(<?= $book['id'] ?>, '<?= htmlspecialchars($book['title']) ?>')">
                                        <i class="fas fa-trash me-2"></i>Excluir Livro
                                    </button>
                                    <a href="index.php?action=my_books" class="btn btn-outline-secondary">
                                        <i class="fas fa-list me-2"></i>Ver Todos os Livros
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação de exclusão -->
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

    <!-- Bootstrap 5 JS -->
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

