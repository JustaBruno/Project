<?php include('layouts/header.php'); ?>

<?php
// Receção da data enviada pelo utilizador através do método POST
$data_nascimento = $_POST['data_nascimento'] ?? null;

// Leitura e carregamento da base de dados em XML
$xml = simplexml_load_file('signos.xml');

// Validação simples para evitar erros
if (!$data_nascimento || !$xml) {
    echo "<div class='container mt-5 text-center'>
            <h3 class='text-danger'>Erro ao processar os dados.</h3>
            <p>Por favor, volte à página inicial e insira uma data válida.</p>
            <a href='index.php' class='btn btn-primary'>Voltar</a>
          </div>";
    exit;
}
?>

<!-- Estrutura HTML que envolverá o resultado final (será preenchida depois) -->
<div class="container d-flex justify-content-center mt-5">
    <!-- O resultado do processamento aparecerá aqui -->
</div>

</body>
</html>