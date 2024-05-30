<?php
require 'auth.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hora_inicio = $_POST['hora_inicio'];
    $period = $_POST['period'];
    $dosage = $_POST['dosage'];

    $start_datetime = $start_date . " " .  $hora_inicio;
    $end_datetime = $end_date . " 23:59:00";




    if (empty($name) || empty($start_date) || empty($end_date) || empty($period) || empty($dosage)) {
        $message = "Todos os campos são obrigatórios.";
    } else {
        $dbPath = 'database.sqlite';
        try {
            $conn = new PDO("sqlite:$dbPath");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("UPDATE medication SET name = :name, start_date = :start_date, end_date = :end_date, period = :period, dosage = :dosage WHERE id = :id");

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':start_date', $start_datetime);
            $stmt->bindParam(':end_date', $end_datetime);
            $stmt->bindParam(':period', $period);
            $stmt->bindParam(':dosage', $dosage);
            
            $stmt->execute();
            $message = "Editado o remédio.";
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
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Criar conta</title>
</head>
<body>
    <main class="p-5 mx-auto d-flex flex-column justify-content-center" style="max-width: 900px;">
        <div class="w-100">
            <section>
                <div class="d-flex flex-column">
                    <span style="font-size: 600%" class="mx-auto material-symbols-outlined">check_circle</span>
                    <h1 class="fw-bold text-center">Confirmação de adição de medicamento</h1>
                </div>
            </section>
            <section>
                <?php if (!empty($message)): ?>
                    <p class="text-center"><?php echo htmlspecialchars($message); ?></p>
                    <?php endif; ?>
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
