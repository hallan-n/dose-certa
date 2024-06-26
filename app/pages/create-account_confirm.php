<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $password = $_POST['password'];

    // Validar os dados (exemplo básico de validação)
    if (empty($name) || empty($email) || empty($tel) || empty($password)) {
        $message = "Todos os campos são obrigatórios.";
    } else {
        // Caminho para o banco de dados SQLite
        $dbPath = 'database.sqlite';

        // Conectar ao banco de dados SQLite
        try {
            $conn = new PDO("sqlite:$dbPath");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Criar a tabela se não existir
            $createTableQuery = "
                CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL UNIQUE,
                    tel TEXT NOT NULL,
                    password TEXT NOT NULL
                )
            ";
            $conn->exec($createTableQuery);

            // Proteger contra SQL Injection
            $stmt = $conn->prepare("INSERT INTO users (name, email, tel, password) VALUES (:name, :email, :tel, :password)");

            // Criptografar a senha
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Vincular os parâmetros
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':password', $hashed_password);

            // Executar a inserção
            $stmt->execute();

            $message = "Conta criada com sucesso.";
        } catch (PDOException $e) {
            $message = "Erro: " . $e->getMessage();
        }

        // Fechar a conexão
        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Criar conta</title>
</head>
<body>
<main class="p-5 mx-auto d-flex flex-column justify-content-center" style="max-width: 900px;">
        <div class="w-100">
            <section>
                <div class="d-flex flex-column">
                    <span style="font-size: 600%" class="mx-auto material-symbols-outlined">account_circle</span>
                    <h1 class="fw-bold text-center">Confirmação de Cadastro</h1>
                </div>
            </section>
            <section>
                <?php if (!empty($message)): ?>
                    <p class="text-center"><?php echo htmlspecialchars($message); ?></p>
                <?php endif; ?>
            </section>
        </div>
        <a href="/" class="d-flex align-items-center justify-content-center text-decoration-none mt-5  ">
            <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>
            <p class="text-dark ps-1">Voltar</p>
        </a>
    </main>
</body>
</html>
