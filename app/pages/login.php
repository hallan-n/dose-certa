<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Caminho para o banco de dados SQLite
    $dbPath = 'database.sqlite';

    // Conectar ao banco de dados SQLite
    try {
        $conn = new PDO("sqlite:$dbPath");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar a consulta SQL para buscar o usuário pelo email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verificar se o usuário existe
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            // Verificar se a senha está correta
            if (password_verify($password, $user['password'])) {
                // Iniciar a sessão do usuário
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                
                // Redirecionar para a página inicial ou dashboard
                header("Location: medication_list.php");
                exit();
            } else {
                $message = "Senha incorreta.";
            }
        } else {
            $message = "Email não encontrado.";
        }
    } catch (PDOException $e) {
        $message = "Erro: " . $e->getMessage();
    }

    // Fechar a conexão
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/account.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Login</title>
</head>

<body>
    <main class="p-5 d-flex align-items-center">
        <div class="w-100">
            <section>
                <div class="d-flex flex-column mb-4">
                    <span style="font-size: 600%" class="mx-auto material-symbols-outlined">account_circle</span>
                    <h1 class="text-nowrap fw-bold text-center">Login</h1>
                </div>
            </section>
            <section>
                <?php if (isset($message)): ?>
                <p class="text-center">
                    <?php echo htmlspecialchars($message); ?>
                </p>
                <?php endif; ?>
                <form class="d-flex flex-column mx-auto" action="/pages/login.php" method="post">
                    <input class="form-control mt-2 p-2" type="email" name="email" id="email" placeholder="Email"
                        required minlength="3" maxlength="255" autocomplete="email">
                    <div class="visibility-container">
                        <input class="form-control mt-2 p-2 pe-5" id="password" name="password" placeholder="Senha"
                            type="password" minlength="3" maxlength="255" autocomplete="current-password" required>
                        <span onclick="visibilityPass()" id="visibility-pass"
                            class="material-symbols-outlined pt-2 visibility-button">visibility_off</span>
                    </div>
                    <div class="mt-4 d-flex align-items-center justify-content-between">
                        <a class="text-decoration-none fw-bold" href="pages/create-account.php">Não possui conta?</a>
                        <div>
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Lembrar de mim</label>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-4 p-2" type="submit">Entrar</button>
                </form>
            </section>
        </div>
    </main>
    <script src="../assets/js/utils.js"></script>
</body>

</html>