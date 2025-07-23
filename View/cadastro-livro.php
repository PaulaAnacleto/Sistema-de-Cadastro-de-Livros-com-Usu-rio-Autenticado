<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - BookManager</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../templates/assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navigation -->
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
                        <a class="nav-link active" href="cadastro-livro.php">
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
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Cadastrar Livro</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container fade-in">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-plus-circle text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Adicionar Novo Livro</h2>
                        <p class="text-muted">Preencha as informações do livro para adicioná-lo à sua biblioteca</p>
                    </div>

                    <!-- Alert Container -->
                    <div id="alertContainer"></div>

                    <!-- Cadastro Form -->
                    <form id="cadastroLivroForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="titulo" class="form-label">
                                    <i class="fas fa-book me-2"></i>Título *
                                </label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required 
                                       placeholder="Digite o título do livro">
                            </div>
                            <div class="col-md-4">
                                <label for="ano" class="form-label">
                                    <i class="fas fa-calendar me-2"></i>Ano de Publicação *
                                </label>
                                <input type="number" class="form-control" id="ano" name="ano" required 
                                       placeholder="Ex: 2023" min="1000" max="2024">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label for="autor" class="form-label">
                                    <i class="fas fa-user me-2"></i>Autor *
                                </label>
                                <input type="text" class="form-control" id="autor" name="autor" required 
                                       placeholder="Digite o nome do autor">
                            </div>
                            <div class="col-md-6">
                                <label for="editora" class="form-label">
                                    <i class="fas fa-building me-2"></i>Editora *
                                </label>
                                <input type="text" class="form-control" id="editora" name="editora" required 
                                       placeholder="Digite o nome da editora">
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label for="isbn" class="form-label">
                                    <i class="fas fa-barcode me-2"></i>ISBN
                                </label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       placeholder="Ex: 978-85-359-0277-5">
                                <div class="form-text">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Formato: 10 ou 13 dígitos (com ou sem hífens)
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">
                                    <i class="fas fa-tags me-2"></i>Gênero/Categoria *
                                </label>
                                <select class="form-select" id="genero" name="genero" required>
                                    <option value="">Selecione um gênero</option>
                                    <option value="Literatura Brasileira">Literatura Brasileira</option>
                                    <option value="Literatura Estrangeira">Literature Estrangeira</option>
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
                        </div>

                        <div class="mt-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle me-2"></i>Status *
                            </label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Selecione o status</option>
                                <option value="Disponível" selected>Disponível</option>

                                <option value="Emprestado">Emprestado</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="descricao" class="form-label">
                                <i class="fas fa-align-left me-2"></i>Descrição
                            </label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="4" 
                                      placeholder="Digite uma breve descrição ou sinopse do livro (opcional)"></textarea>
                            <div class="form-text">
                                <small class="text-muted">
                                    <span id="contadorCaracteres">0</span>/500 caracteres
                                </small>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-3">
                            <button type="submit" class="btn btn-primary flex-fill" id="btnCadastrar">
                                <i class="fas fa-save me-2"></i>Salvar Livro
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="limparFormulario()">
                                <i class="fas fa-eraser me-2"></i>Limpar
                            </button>
                            <a href="meus-livros.php" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Voltar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            }
            
            // Configurar contador de caracteres
            const descricaoTextarea = document.getElementById('descricao');
            const contadorCaracteres = document.getElementById('contadorCaracteres');
            
            descricaoTextarea.addEventListener('input', function() {
                const caracteres = this.value.length;
                contadorCaracteres.textContent = caracteres;
                
                if (caracteres > 500) {
                    this.value = this.value.substring(0, 500);
                    contadorCaracteres.textContent = 500;
                }
                
                // Mudar cor baseado no limite
                if (caracteres > 450) {
                    contadorCaracteres.className = 'text-danger';
                } else if (caracteres > 400) {
                    contadorCaracteres.className = 'text-warning';
                } else {
                    contadorCaracteres.className = 'text-muted';
                }
            });
            
            // Form submission
            const form = document.getElementById('cadastroLivroForm');
            const btnCadastrar = document.getElementById('btnCadastrar');
            
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (!BookManager.validarFormulario(form)) {
                    BookManager.mostrarAlerta('danger', 'Por favor, corrija os erros no formulário antes de continuar.');
                    return;
                }

                const formData = new FormData(form);
                const dados = {
                    titulo: formData.get('titulo'),
                    autor: formData.get('autor'),
                    isbn: formData.get('isbn') || 'N/A',
                    editora: formData.get('editora'),
                    ano: parseInt(formData.get('ano')),
                    genero: formData.get('genero'),
                    descricao: formData.get('descricao') || 'Sem descrição',
                    status: formData.get('status')
                };

                const textoOriginal = btnCadastrar.innerHTML;
                BookManager.mostrarLoading(btnCadastrar);

                try {
                    const resposta = await BookManager.simularRequisicaoHTTP('POST', '/api/livros', dados);
                    
                    BookManager.mostrarAlerta('success', 'Livro cadastrado com sucesso! Redirecionando...');
                    
                    setTimeout(() => {
                        window.location.href = 'meus-livros.php';
                    }, 2000);
                    
                } catch (error) {
                    BookManager.mostrarAlerta('danger', error.erro || 'Erro ao cadastrar livro. Tente novamente.');
                    BookManager.esconderLoading(btnCadastrar, textoOriginal);
                }
            });
        });

        function limparFormulario() {
            if (confirm('Tem certeza que deseja limpar todos os campos?')) {
                document.getElementById('cadastroLivroForm').reset();
                document.getElementById('contadorCaracteres').textContent = '0';
                document.getElementById('contadorCaracteres').className = 'text-muted';
                
                // Remove validação visual
                const campos = document.querySelectorAll('.form-control, .form-select');
                campos.forEach(campo => {
                    campo.classList.remove('is-valid', 'is-invalid');
                });
                
                // Remove mensagens de feedback
                const feedbacks = document.querySelectorAll('.invalid-feedback, .valid-feedback');
                feedbacks.forEach(feedback => feedback.remove());
            }
        }
    </script>
</body>
</html>

