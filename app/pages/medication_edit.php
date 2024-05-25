<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET["id"];
        $dbPath = 'database.sqlite';
        try {
            $conn = new PDO("sqlite:$dbPath");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM medication WHERE id=".$id;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = "Erro: " . $e->getMessage();
        }
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
                <form class="d-flex flex-column mx-auto" action="medication_add.php" method="post">
                    <h1 class="text-nowrap fw-bold">Editar Remédio</h1>
                    <label class="form-label mt-3" for="name">Nome</label>
                    <input class="form-control p-2" type="text" name="name" id="name" value="<?php echo htmlspecialchars($results[0]['name']); ?>"/>
                    <label class="form-label mt-3" for="start_date">Data de início</label>
                    <input class="form-control p-2" type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($results[0]['start_date']); ?>">
                    <label class="form-label mt-3" for="end_date">Data de término</label>
                    <input class="form-control p-2" type="date" name="end_date" id="end_date" value="<?php echo htmlspecialchars($results[0]['end_date']); ?>">
                    <label class="form-label mt-3" for="period">Período</label>
                    <select class="form-select p-2" name="period" id="period" value="<?php echo htmlspecialchars($results[0]['period']); ?>">
                        <option  disabled>Selecione ...</option>
                        <option value="4"<?php if (htmlspecialchars($results[0]['period'])=='4')echo'selected'; ?>>Cada 4 horas</option>
                        <option value="6"<?php if (htmlspecialchars($results[0]['period'])=='6')echo'selected'; ?>>Cada 6 horas</option>
                        <option value="8"<?php if (htmlspecialchars($results[0]['period'])=='8')echo'selected'; ?>>Cada 8 horas</option>
                        <option value="12"<?php if (htmlspecialchars($results[0]['period'])=='12')echo'selected'; ?>>Cada 12 horas</option>
                    </select>
                    <label class="form-label mt-3" for="dosage">Dosagem</label>
                    <input class="form-control p-2" type="text" name="dosage" id="dosage" value="<?php echo htmlspecialchars($results[0]['dosage']); ?>">
                    <button class="btn btn-primary mt-4 p-2" type="submit">Confirmar</button>
                    <div class="d-flex gap-2">
                        <a href="<?php echo '/pages/medication_delete_confirm.php?id='.htmlspecialchars($results[0]['id'])?>" class="btn btn-danger mt-2 p-2 w-100">Exluir</a>
                        <a href="/pages/medication_list.php" class="btn btn-secondary mt-2 p-2 w-100">Cancelar</a>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php include "../assets/shared/footer.php" ?>
</body>

</html>