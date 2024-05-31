<link rel="stylesheet" href="../assets/shared/header.css">

<header class="p-4" style="background-color: rgb(5,80,156);">
    <div class="d-flex justify-content-between mx-auto px-3 align-items-center" style="max-width: 900px;">
        <a href="/pages/medication_list.php">
            <img src="../assets/images/logo.png" alt="logo" width="100" height="100%">
        </a>
        <div>
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
