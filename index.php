<?php include('layouts/header.php'); ?>

<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <!-- Card centralizado usando Bootstrap -->
    <div class="card shadow-lg p-5" style="max-width: 450px; width: 100%; border-radius: 15px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Descubra seu Signo</h2>
            <p class="text-muted">Informe sua data de nascimento para consultar a nossa base zodiacal.</p>
        </div>
        
        <!-- Formulário apontando para a lógica em PHP -->
        <form action="show_zodiac_sign.php" method="POST">
            <div class="mb-4">
                <label for="data_nascimento" class="form-label fw-semibold">Data de Nascimento</label>
                <!-- HTML5 Date Input aciona o calendário do navegador -->
                <input type="date" class="form-control form-control-lg" id="data_nascimento" name="data_nascimento" required>
            </div>
            
            <div class="d-grid mt-2">
                <button type="submit" class="btn btn-primary btn-lg fw-bold">Descobrir</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>