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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Criar conta</title>
</head>

<body>
    <?php include "../assets/shared/header.php" ?>
    <main class="p-4 mx-auto h-100" style="max-width: 900px;">
        <a href="/pages/medication_list.php">
            <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>
        </a>
        <div class="w-100">            
            <section>
                <form onsubmit="return validateDate()" class="d-flex flex-column mx-auto" action="medication_add_confirm.php" method="post">
                    <h1 class="text-nowrap fw-bold">Adicionar remédio</h1>
                    <label class="form-label mt-3" for="name">Nome</label>
                    <input class="form-control p-2" type="text" name="name" id="name" minlength="3" maxlength="255" required>
                    <label class="form-label mt-3" for="start_date">Data de início</label>
                    <input class="form-control p-2" type="date" name="start_date" id="start_date" required>
                    <label class="form-label mt-3" for="end_date">Data de término</label>
                    <input class="form-control p-2" type="date" name="end_date" id="end_date" required >
                    <label class="form-label mt-3" for="hora_inicio">Hora de Início</label>
                    <input type="time"
                        class="form-control p-2"
                        name="hora_inicio"
                        id="hora_inicio" required/>
                    <label class="form-label mt-3" for="period">Período</label>
                    <select class="form-select p-2" name="period" id="period" required>
                        <option selected disabled value="">Selecione ...</option>
                        <option value="4">Cada 4 horas</option>
                        <option value="6">Cada 6 horas</option>
                        <option value="8">Cada 8 horas</option>
                        <option value="12">Cada 12 horas</option>
                    </select>
                    <label class="form-label mt-3" for="dosage">Dosagem</label>
                    <input class="form-control p-2" type="text" name="dosage" id="dosage" required minlength="2" maxlength="255">
                    <button class="btn btn-primary mt-4 p-2" type="submit">Confirmar</button>
                </form>
            </section>
        </div>
    </main>
    <?php include "../assets/shared/footer.php" ?>
    <script src="../assets/js/utils.js"></script>
</body>
</html>