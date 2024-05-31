<?php

require 'auth.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['user_id'];
    $previous = $_POST['previous'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($id) || empty($previous) || empty($new_password) || empty($confirm_password)) {
        $message = "Todos os campos são obrigatórios.";
    } else {
        $dbPath = 'database.sqlite';
        try {
            $conn = new PDO("sqlite:$dbPath");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");

                if (password_verify($previous, $user['password']) && $new_password === $confirm_password) {
                    try {

                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $stmt->bindParam(':password', $hashed_password);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $message = "Senha alterada com sucesso!";
                        session_unset();
                        session_destroy();
                        
                    }
                    catch (PDOException $e){
                        $message = "Erro: " . $e->getMessage();
                    }
                }
            } else {
                $message = "Usuário não encontrado";
            }
        } catch (PDOException $e) {
            $message = "Erro: " . $e->getMessage();
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Criar conta</title>
</head>

<body>
    <main class="p-5 mx-auto d-flex flex-column justify-content-center" style="max-width: 900px;">
        <div class="w-100">
            <section>
                <div class="d-flex flex-column">
                    <span style="font-size: 600%" class="mx-auto material-symbols-outlined">check_circle</span>
                    <?php if (!empty($message)): ?>
                        <h1 class="fw-bold text-center"><?php echo htmlspecialchars($message); ?></h1>
                    <?php endif; ?>
                </div>
            </section>
        </div>
        <a href="/pages/medication_list.php" class="d-flex align-items-center justify-content-center text-decoration-none mt-5  ">
            <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>
            <p class="text-dark ps-1">Voltar</p>
        </a>
        </div>
    </main>
</body>

</html>