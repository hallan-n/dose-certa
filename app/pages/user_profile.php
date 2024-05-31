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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Criar conta</title>
</head>

<body>
    <?php include "../assets/shared/header.php" ?>
    <main class="p-4 mx-auto h-100" style="max-width: 900px;">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-back" style="all: unset;">
            <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>            
        </button>
        <!-- MODAL -->
        <div class="modal fade" id="modal-back" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tem certeza que deseja sair?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><b>Atenção:</b> Se você sair desta página, algumas alterações não serão salvas!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="/pages/medication_list.php">Confirmar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL -->
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
                    <input oninput="phoneMask(this)" class="form-control mt-2 p-2" type="tel" name="tel" id="tel" value="<?php echo $results[0]['tel']; ?>" required  minlength="8" maxlength="14">
                    <div class="mt-3 d-flex gap-3 "> 
                        <button class="btn btn-primary w-100 p-2" type="button" data-bs-toggle="modal" data-bs-target="#modal-confirm">Salvar</button>
                        <button id="save" class="d-none btn btn-primary w-100 p-2" type="submit">Salvar</button>
                        <a href="/pages/medication_list.php" class="btn btn-secondary w-100  p-2" type="submit">Cancelar </a>
                    </div>
                    <a href="/pages/user_password.php" class="btn btn-danger mt-3 w-100  p-2" type="submit">Alterar senha</a>
                </form>
            </section>
        </div>
    </main>
        <!-- MODAL -->
        <div class="modal fade" id="modal-confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tem certeza que deseja salvar?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><b>Atenção:</b> Verifique todos os dados antes de salvar!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <label for="save" class="btn btn-primary">Confirmar</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL -->
    <?php include "../assets/shared/footer.php" ?>
    <script src="../assets/js/utils.js"></script>
</body>
</html>