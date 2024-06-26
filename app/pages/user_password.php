<?php
    require 'auth.php';
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
        <a href="/pages/user_profile.php">
            <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>
        </a>
        <div class="w-100 d-flex gap-5 mt-5" id="user_limited">
            <section class="w-100" id="user_img">
                <img src="../assets/images/login.jpg" alt="" width="100%" style="max-width: 502px;">
            </section>
            <section class="w-100">
                <form class="d-flex flex-column mx-auto" action="user_password_confirm.php" method="post">
                    <h1 class="text-nowrap fw-bold">Editar senha</h1>
                    <label class="form-label mt-3" for="previous">Senha antiga:</label>
                    <input class="form-control p-2" type="password" name="previous" id="previous" required  minlength="3" maxlength="255">
                    <label class="form-label mt-3" for="new_password">Senha nova:</label>
                    <input class="form-control p-2" type="password" name="new_password" id="new_password" required  minlength="3" maxlength="255">
                    <label class="form-label mt-3" for="confirm_password">Confirmação de senha:</label>
                    <input class="form-control p-2" type="password" name="confirm_password" id="confirm_password" required  minlength="3" maxlength="255">
                    <div class="mt-3 d-flex gap-3 "> 
                        <button class="btn btn-primary w-100 p-2" type="button" data-bs-toggle="modal" data-bs-target="#modal">Salvar</button>
                        <button id="btn-sub" class="d-none btn btn-primary w-100 p-2" type="submit">Salvar</button>
                        <a href="/pages/user_profile.php" class="btn btn-secondary w-100  p-2" type="submit">Voltar</a>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <!-- MODAL -->
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tem certeza que deseja salvar?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><b>Atenção:</b> Sua senha será alterada e você precisará realizar o login novamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <label for="btn-sub" class="btn btn-primary">Salvar</label>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->

    <?php include "../assets/shared/footer.php" ?>
</body>
</html>