<?php include('layouts/header.php'); ?>

<?php
// Receção da data enviada pelo utilizador através do método POST
$data_nascimento = $_POST['data_nascimento'] ?? null;

// Leitura e carregamento da base de dados em XML
$xml = simplexml_load_file('signos.xml');

// Validação simples para evitar erros caso a página seja acedida diretamente
if (!$data_nascimento || !$xml) {
    echo "<div class='container mt-5 text-center'>
            <h3 class='text-danger'>Erro ao processar os dados.</h3>
            <p>Por favor, volte à página inicial e insira uma data válida.</p>
            <a href='index.php' class='btn btn-primary'>Voltar</a>
          </div>";
    exit;
}

// 1. Converte a data do utilizador para focar apenas no Mês e Dia (formato: m-d)
$data_usuario = new DateTime($data_nascimento);
$mes_dia_usuario = $data_usuario->format('m-d');
$signo_encontrado = null;

// 2. Itera sobre cada signo presente no XML
foreach ($xml->signo as $signo) {
    // Converte os formatos DD/MM do XML para MM-DD para permitir a comparação
    $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio)->format('m-d');
    $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim)->format('m-d');

    // 3. Lógica de Comparação
    if ($inicio > $fim) {
        // Exceção: O signo cruza a viragem do ano (ex: Capricórnio - 12-22 a 01-19)
        // Usamos OR (||) pois a data deve ser no final do ano OU no início do ano seguinte
        if ($mes_dia_usuario >= $inicio || $mes_dia_usuario <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    } else {
        // Regra Padrão: O signo começa e termina no mesmo ano (ex: Áries - 03-21 a 04-19)
        // Usamos AND (&&) pois a data tem de estar obrigatoriamente dentro desse intervalo
        if ($mes_dia_usuario >= $inicio && $mes_dia_usuario <= $fim) {
            $signo_encontrado = $signo;
            break;
        }
    }
}
?>

<!-- Estrutura HTML apresentando o resultado final -->
<div class="container d-flex justify-content-center mt-5">
    <?php if ($signo_encontrado): ?>
        <div class="card shadow p-4 text-center" style="max-width: 450px; border-radius: 15px;">
            <h2 class="text-primary fw-bold mb-2">
                <?= htmlspecialchars($signo_encontrado->signoNome) ?>
            </h2>
            <p class="text-muted fw-semibold mb-4">
                De <?= $signo_encontrado->dataInicio ?> até <?= $signo_encontrado->dataFim ?>
            </p>
            <p class="fs-5 mb-4 px-2">
                <?= htmlspecialchars($signo_encontrado->descricao) ?>
            </p>
            <a href="index.php" class="btn btn-outline-primary fw-bold">Consultar outro signo</a>
        </div>
    <?php else: ?>
        <!-- Tratamento de erro caso a data não encontre correspondência -->
        <div class="card shadow p-4 text-center border-danger" style="max-width: 450px; border-radius: 15px;">
            <h3 class="text-danger fw-bold">Signo não encontrado!</h3>
            <p>Verifique a data introduzida e tente novamente.</p>
            <a href="index.php" class="btn btn-primary fw-bold mt-3">Voltar</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>