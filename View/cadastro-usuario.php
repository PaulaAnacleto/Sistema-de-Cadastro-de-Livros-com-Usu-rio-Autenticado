<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - BookManager</title>
    
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-book-open me-2"></i>BookManager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cadastro-usuario.php">
                            <i class="fas fa-user-plus me-1"></i>Cadastrar-se
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="form-container fade-in">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-user-plus text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Criar Conta</h2>
                        <p class="text-muted">Junte-se ao BookManager e organize sua biblioteca</p>
                    </div>

                    <!-- Alert Container -->
                    <div id="alertContainer"></div>

                    <!-- Cadastro Form -->
                    <form id="cadastroForm" novalidate>
                        <div class="mb-3">
                            <label for="nome" class="form-label">
                                <i class="fas fa-user me-2"></i>Nome Completo
                            </label>
                            <input type="text" class="form-control" id="nome" name="nome" required 
                                   placeholder="Digite seu nome completo">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>E-mail
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required 
                                   placeholder="Digite seu e-mail">
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">
                                <i class="fas fa-lock me-2"></i>Senha
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="senha" name="senha" required 
                                       placeholder="Digite sua senha">
                                <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Mínimo 8 caracteres, incluindo maiúscula, minúscula, número e caractere especial
                                </small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirmarSenha" class="form-label">
                                <i class="fas fa-lock me-2"></i>Confirmar Senha
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required 
                                       placeholder="Confirme sua senha">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmarSenha">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="termos" name="termos" required>
                            <label class="form-check-label" for="termos">
                                Eu concordo com os <a href="#" class="text-primary">Termos de Uso</a> e 
                                <a href="#" class="text-primary">Política de Privacidade</a>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="btnCadastrar">
                                <i class="fas fa-user-plus me-2"></i>Criar Conta
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">
                            Já tem uma conta? 
                            <a href="login.php" class="text-primary fw-bold text-decoration-none">
                                Faça login aqui
                            </a>
                        </p>
                    </div>
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
            const form = document.getElementById('cadastroForm');
            const btnCadastrar = document.getElementById('btnCadastrar');
            const toggleSenha = document.getElementById('toggleSenha');
            const toggleConfirmarSenha = document.getElementById('toggleConfirmarSenha');
            const senhaInput = document.getElementById('senha');
            const confirmarSenhaInput = document.getElementById('confirmarSenha');

            // Toggle password visibility
            toggleSenha.addEventListener('click', function() {
                const type = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
                senhaInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            toggleConfirmarSenha.addEventListener('click', function() {
                const type = confirmarSenhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmarSenhaInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Form submission
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                if (!BookManager.validarFormulario(form)) {
                    BookManager.mostrarAlerta('danger', 'Por favor, corrija os erros no formulário antes de continuar.');
                    return;
                }

                const formData = new FormData(form);
                const dados = {
                    nome: formData.get('nome'),
                    email: formData.get('email'),
                    senha: formData.get('senha'),
                    confirmarSenha: formData.get('confirmarSenha')
                };

                const textoOriginal = btnCadastrar.innerHTML;
                BookManager.mostrarLoading(btnCadastrar);

                try {
                    const resposta = await BookManager.simularRequisicaoHTTP('POST', '/api/usuarios', dados);
                    
                    BookManager.mostrarAlerta('success', 'Conta criada com sucesso! Redirecionando para o login...');
                    
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 2000);
                    
                } catch (error) {
                    BookManager.mostrarAlerta('danger', error.erro || 'Erro ao criar conta. Tente novamente.');
                    BookManager.esconderLoading(btnCadastrar, textoOriginal);
                }
            });
        });
    </script>
</body>
</html>

