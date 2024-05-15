<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/account.css">
    <title>Login</title>
</head>

<body>
<main class="p-5 d-flex align-items-center">
    <div class="w-100">
        <section>
            <div class="d-flex flex-column ">
                <span style="font-size: 600%" class="mx-auto material-symbols-outlined">account_circle</span>
                <h1 class="text-nowrap fw-bold text-center">Login</h1>
            </div>
        </section>
        <section>
            <form class="d-flex flex-column mx-auto" action="">
                <input class="form-control mt-2 p-2" type="email" name="email" id="email" placeholder="Email">
                <input class="form-control mt-2 p-2" type="password" name="password" id="password"
                       placeholder="Senha">
                <div class="mt-4 d-flex align-items-center justify-content-between">
                    <a class="text-decoration-none fw-bold" href="create-account.php">Não possui conta?</a>
                    <div>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Lembrar de mim</label>
                    </div>
                </div>
                <button class="btn btn-primary mt-4 p-2" type="button">Entrar</button>
            </form>
        </section>
    </div>
</main>
</body>
</html>