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
    <main class="px-5 d-flex align-items-center flex-column justify-content-center">
        <div class="w-100 d-flex" id="user_limited">
            <section class="w-100" id="user_img">
                <img src="../assets/images/account-edit.png" alt="" width="100%" style="max-width: 502px;">
            </section>
            <section class="w-100">
                <form class="d-flex flex-column mx-auto" action="" method="post">
                    <h1 class="text-nowrap fw-bold">Editar Perfil</h1>
                    <label class="form-label mt-3" for="text">Nome</label>
                    <input class="form-control mt-2 p-2" type="text" name="name" id="name">
                    <label class="form-label mt-3" for="email">Email</label>
                    <input class="form-control mt-2 p-2" type="email" name="email" id="email">
                    <label class="form-label mt-3" for="tel">Telefone</label>
                    <input class="form-control mt-2 p-2" type="tel" name="tel" id="tel">
                    <div class="mt-3 d-flex gap-3 "> 
                        <button class="btn btn-primary w-100 p-2" type="submit">Salvar</button>
                        <a href="/" class="btn btn-secondary w-100  p-2" type="submit">Cancelar </a>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php include "../assets/shared/footer.php" ?>
</body>

</html>