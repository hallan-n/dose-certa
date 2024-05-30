
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/account.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Criar conta</title>
</head>
<body>
    <main class="p-5 d-flex align-items-center">
        <div class="w-100">
            <section>
                <div class="d-flex flex-column mb-4">
                    <span style="font-size: 600%" class="mx-auto material-symbols-outlined">account_circle</span>
                    <h1 class="text-nowrap fw-bold text-center">Criar login</h1>
                </div>
            </section>
            <section>
                <form class="d-flex flex-column mx-auto" action="create-account_confirm.php" method="post">
                    <input class="form-control mt-2 p-2" type="text" name="name" id="name" placeholder="Nome" required minlength="3" maxlength="255">
                    <input class="form-control mt-2 p-2" type="email" name="email" id="email" placeholder="Email" required minlength="3" maxlength="255">
                    <input class="form-control mt-2 p-2" type="tel" name="tel" id="tel" placeholder="Telefone" required minlength="8" maxlength="11">
                    <input class="form-control mt-2 p-2" type="password" name="password" id="password" placeholder="Senha" required>
                    <a class="text-end mt-4 text-decoration-none fw-bold" href="/">Ja possui conta?</a>
                    <button class="btn btn-primary mt-4 p-2" type="submit">Criar conta</button>
                </form>
            </section>
        </div>
    </main>
    <?php include "../assets/shared/footer.php" ?>
</body>
</html>