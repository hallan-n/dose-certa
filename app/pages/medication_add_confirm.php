<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hora_inicio = $_POST['hora_inicio'];
    $period = $_POST['period'];
    $dosage = $_POST['dosage'];
    
    $start_datetime = $start_date . " " .  $hora_inicio . ":00" ;
    $end_datetime = $end_date . " 23:59:00";

    if (empty($name) || empty($start_date) || empty($end_date) || empty($period) || empty($dosage)) {
        $message = "Todos os campos são obrigatórios.";
    } else {
        $dbPath = 'database.sqlite';
        try {
            $conn = new PDO("sqlite:$dbPath");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $createTableQuery = "
                CREATE TABLE IF NOT EXISTS medication (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name VARCHAR NOT NULL,
                    start_date VARCHAR NOT NULL,
                    end_date VARCHAR NOT NULL,
                    period VARCHAR NOT NULL,
                    dosage VARCHAR NOT NULL
                )
            ";
            $conn->exec($createTableQuery);
            $stmt = $conn->prepare("INSERT INTO medication (name,start_date,end_date,period,dosage) VALUES (:name, :start_date, :end_date, :period, :dosage)");
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':start_date',$start_datetime);
            $stmt->bindParam(':end_date',$end_datetime);
            $stmt->bindParam(':period',$period);
            $stmt->bindParam(':dosage',$dosage);
            $stmt->execute();
            $message = "Adicionado o remédio.";
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
                    <h1 class="text-nowrap fw-bold text-center">Confirmação de adição de medicamento</h1>
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
