<?php
    require 'auth.php';

    $results = null;
    $dbPath = 'database.sqlite';
    try {
        $conn = new PDO("sqlite:$dbPath");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE id = ".$_SESSION['user_id'].";";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $message = "Erro: " . $e->getMessage();
    }
    $conn = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link rel="stylesheet" href="../assets/css/user_profile.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Criar conta</title>
</head>

<body>
    <?php include "../assets/shared/header.php" ?>
    <main class="p-4 mx-auto h-100" style="max-width: 900px;">
        <a href="/pages/medication_list.php">
            <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>
        </a>
        <div class="w-100 d-flex gap-5 mt-5" id="user_limited">
            <section class="w-100" id="user_img">
                <img src="../assets/images/account-edit.png" alt="" width="100%" style="max-width: 502px;">
            </section>
            <section class="w-100">
                <form class="d-flex flex-column mx-auto" action="user_profile_confirm.php" method="post">
                    <h1 class="text-nowrap fw-bold">Editar Perfil</h1>
                    <label class="form-label mt-3" for="text">Nome</label>
                    <input class="form-control mt-2 p-2" type="text" name="name" id="name" value="<?php echo $results[0]['name']; ?>" required  minlength="3" maxlength="255">
                    <label class="form-label mt-3" for="email">Email</label>
                    <input class="form-control mt-2 p-2" type="email" name="email" id="email" value="<?php echo $results[0]['email']; ?>" required  minlength="3" maxlength="255">
                    <label class="form-label mt-3" for="tel">Telefone</label>
                    <input class="form-control mt-2 p-2" type="tel" name="tel" id="tel" value="<?php echo $results[0]['tel']; ?>" required  minlength="3" maxlength="255">
                    <div class="mt-3 d-flex gap-3 "> 
                        <button class="btn btn-primary w-100 p-2" type="submit">Salvar</button>
                        <a href="/pages/medication_list.php" class="btn btn-secondary w-100  p-2" type="submit">Cancelar </a>
                    </div>
                    <a href="/pages/user_password.php" class="btn btn-danger mt-3 w-100  p-2" type="submit">Alterar senha</a>
                </form>
            </section>
        </div>
    </main>
    <?php include "../assets/shared/footer.php" ?>
</body>
</html>