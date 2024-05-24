<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/medication_list.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <title>Lista de remédios</title>
</head>
<body>
    <?php include "../assets/shared/header.php" ?>
    <main class="p-4 mx-auto" style="max-width: 900px;">
        <span id="arrow_back" class="material-symbols-outlined p-3 mb-3">arrow_back</span>
        <div class="d-flex justify-content-between mt-4 mb-4">
            <h1 class="text-nowrap fw-bold">Lista de remédios</h1>
            <div id="add-div">
                <div id="add">
                    <span class="add-bt material-symbols-outlined p-2 me-2">menu</span>
                    <span class="add-bt material-symbols-outlined p-2 me-2">notifications</span>
                    <span class="add-bt material-symbols-outlined p-3 me-2">add</span>
                </div>
            </div>
        </div>
        <div id="medications" class="d-flex flex-wrap justify-content-between">
            <div class="remedy align-items-center rounded my-2"
                style="display: inline-flex; gap: 6px; background-color: rgb(202, 202, 202); overflow: hidden;">
                <div class="bg-secondary h-100 p-2">
                    <span class="material-symbols-outlined text-light mt-1 px-2">pill</span>
                </div>
                <div class="px-2">
                    <p class="m-0 text-secondary" style="font-size: .6rem; text-wrap: nowrap;">12h</p>
                    <p class="m-0 text-secondary" style="font-size: .8rem; text-wrap: nowrap;">Remédio de pressão</p>
                </div>
                <div id="edit" class="h-100 d-flex p-2" style="gap: 6px; cursor: pointer;">
                    <div class="bg-secondary" style="width: 2px;">&nbsp;</div>
                    <span class="material-symbols-outlined px-2 mt-1" style="font-size: 25px;">edit_square</span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>