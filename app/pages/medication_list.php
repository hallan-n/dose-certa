<?php
    include 'auth.php';
    $results = null;
    $dbPath = 'database.sqlite';
    try {
        $conn = new PDO("sqlite:$dbPath");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM medication WHERE user_id = ".$_SESSION['user_id'].";";
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
    <link rel="stylesheet" href="../assets/css/medication_list.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Lista de remédios</title>
</head>
<body>

    <header id="fixed-header" class="p-4" style="background-color: rgb(5,80,156);">
        <div class="d-flex justify-content-between mx-auto px-3 align-items-center" style="max-width: 900px;">
            <a href="/pages/medication_list.php">
                <img src="../assets/images/logo.png" alt="logo" width="100" height="100%">
            </a>
            <div>
            <a href="/pages/notification_list.php">
                <span class="fs-1 me-4 text-light material-symbols-outlined button-header">notifications</span>
            </a>
                <a href="/pages/user_profile.php">
                    <span class="fs-1 me-4 text-light material-symbols-outlined button-header">account_circle</span>
                </a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-logout" style="all: unset; cursor: pointer;">
                    <span class="fs-1 text-light material-symbols-outlined button-header">logout</span>
                </button>
            </div>
        </div>
    </header>


    <!-- MODAL -->
    <div class="modal fade" id="modal-logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tem certeza que deseja fazer logout?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><b>Atenção:</b> Sua sessão será encerra, será preciso fazer login novamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="/pages/logout.php">Confirmar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->


    <main class="p-4 mx-auto" style="max-width: 900px;">
        <div id="fixed-div" class="d-flex justify-content-between mt-4 gap-3 pe-5 pt-4">
            <h1 class="fw-bold">Lista de remédios</h1>
            <div>
                <div class="d-flex flex-nowrap align-items-center gap-2">
                <a href="/pages/notification_list.php" class="text-dark">
                    <span class="add-bt material-symbols-outlined p-2 me-2" style="width:40px; height:40px;">notifications</span></a>
                    <a href="/pages/medication_add.php" class="text-dark"><span class="add-bt material-symbols-outlined p-3 me-2">add</span></a>
                </div>
            </div>
        </div>
        <div id="medications" class="d-flex flex-wrap gap-2" style="padding-top:200px;">
            <?php
                if ($results != null) {
                    for ($i = 0; $i < count($results); $i++) {
                        $id = htmlspecialchars($results[$i]["id"]);
                        echo <<<HTML
                        <div class="remedy align-items-center rounded"
                            style="display: inline-flex; gap: 6px; background-color: rgb(202, 202, 202); overflow: hidden;">
                            <div class="bg-secondary h-100 p-2">
                                <span class="material-symbols-outlined text-light mt-1 px-2">pill</span>
                            </div>
                            <div class="px-2 me-auto">
                                <p class="m-0 text-secondary" style="font-size: .6rem; text-wrap: nowrap;">A cada {$results[$i]['period']}h</p>
                                <p class="m-0 text-secondary" style="font-size: .8rem; text-wrap: nowrap;">{$results[$i]['name']}</p>
                            </div>
                            <a href="/pages/medication_edit.php?id=$id" id="edit" class="h-100 d-flex p-2 gap-2 text-decoration-none" style="cursor: pointer;">
                                <div class="bg-secondary" style="width: 2px;">&nbsp;</div>
                                <span class="material-symbols-outlined px-2 mt-1" style="font-size: 25px;">edit_square</span>
                            </a>
                        </div>
                        HTML;
                    }
                }
            ?>
        </div>
    </main>
    <?php include "../assets/shared/footer.php" ?>
</body>
</html>