<!-- 
    Todos os comentários abaixo estão em português conforme solicitado.
-->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookManager</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../templates/assets/css/style.css">
</head>
<body class="bg-light">
    <!-- Navegação -->
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
                        <a class="nav-link active" href="login.php">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro-usuario.php">
                            <i class="fas fa-user-plus me-1"></i>Cadastrar-se
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5 col-md-7">
                <div class="form-container fade-in">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-sign-in-alt text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Bem-vindo de volta!</h2>
                        <p class="text-muted">Acesse sua conta para gerenciar seus livros</p>
                    </div>

                    <!-- Container de alertas -->
                    <div id="alertContainer"></div>

                    <!-- Informações de credenciais de demonstração -->
                    <div class="alert alert-info border-0 mb-4">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-info-circle me-2"></i>Credenciais de Demonstração
                        </h6>
                        <p class="mb-1"><strong>E-mail:</strong> usuario@teste.com</p>
                        <p class="mb-0"><strong>Senha:</strong> Teste123!</p>
                    </div>

                    <!-- Formulário de login -->
                    <form id="loginForm" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>E-mail
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required 
                                   placeholder="Digite seu e-mail" value="usuario@teste.com">
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">
                                <i class="fas fa-lock me-2"></i>Senha
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="senha" name="senha" required 
                                       placeholder="Digite sua senha" value="Teste123!">
                                <button class="btn btn-outline-secondary" type="button" id="toggleSenha">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="lembrarMe" name="lembrarMe">
                                <label class="form-check-label" for="lembrarMe">
                                    Lembrar-me
                                </label>
                            </div>
                            <a href="#" class="text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#esqueceuSenhaModal">
                                Esqueceu a senha?
                            </a>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="btnLogin">
                                <i class="fas fa-sign-in-alt me-2"></i>Entrar
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">
                            Não tem uma conta? 
                            <a href="cadastro-usuario.php" class="text-primary fw-bold text-decoration-none">
                                Cadastre-se aqui
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para recuperação de senha -->
    <div class="modal fade" id="esqueceuSenhaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-key me-2"></i>Recuperar Senha
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Digite seu e-mail para receber as instruções de recuperação de senha.</p>
                    <form id="recuperarSenhaForm">
                        <div class="mb-3">
                            <label for="emailRecuperacao" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="emailRecuperacao" required 
                                   placeholder="Digite seu e-mail">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnRecuperar">
                        <i class="fas fa-paper-plane me-2"></i>Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JS personalizado -->
    <script src="../js/main.js"></script>
    
    <script>
        // Executa quando o DOM estiver totalmente carregado
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const btnLogin = document.getElementById('btnLogin');
            const toggleSenha = document.getElementById('toggleSenha');
            const senhaInput = document.getElementById('senha');
            const btnRecuperar = document.getElementById('btnRecuperar');

            // Alterna a visibilidade da senha
            toggleSenha.addEventListener('click', function() {
                const type = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
                senhaInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Submissão do formulário de login
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Validação do formulário
                if (!BookManager.validarFormulario(form)) {
                    BookManager.mostrarAlerta('danger', 'Por favor, corrija os erros no formulário antes de continuar.');
                    return;
                }

                const formData = new FormData(form);
                const dados = {
                    email: formData.get('email'),
                    senha: formData.get('senha')
                };

                const textoOriginal = btnLogin.innerHTML;
                BookManager.mostrarLoading(btnLogin);

                try {
                    // Simula requisição HTTP de login
                    const resposta = await BookManager.simularRequisicaoHTTP('POST', '/api/login', dados);
                    
                    // Simula armazenamento do token
                    localStorage.setItem('authToken', 'token_simulado_123');
                    localStorage.setItem('usuario', JSON.stringify(resposta.usuario));
                    
                    BookManager.mostrarAlerta('success', 'Login realizado com sucesso! Redirecionando...');
                    
                    setTimeout(() => {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                    
                } catch (error) {
                    BookManager.mostrarAlerta('danger', error.erro || 'Erro ao fazer login. Verifique suas credenciais.');
                    BookManager.esconderLoading(btnLogin, textoOriginal);
                }
            });

            // Recuperação de senha
            btnRecuperar.addEventListener('click', function() {
                const email = document.getElementById('emailRecuperacao').value;
                if (!email) {
                    alert('Por favor, digite seu e-mail.');
                    return;
                }
                
                // Simula envio de e-mail de recuperação
                alert('E-mail de recuperação enviado! Verifique sua caixa de entrada.');
                bootstrap.Modal.getInstance(document.getElementById('esqueceuSenhaModal')).hide();
            });
        });
    </script>
</body>
</html>
