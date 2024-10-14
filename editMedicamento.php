<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Medicamentos</title>
</head>
<body>
    <h3>Editando Medicamento</h3>

    <?php
    require 'conexao.php';

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validação dos dados
        if (empty($_POST['medicamento']) || empty($_POST['valor']) || empty($_POST['estoque']) || empty($_POST['categoria']) || empty($_POST['validade'])) {
            echo "Por favor, preencha todos os campos.";
        } else {
            // Sanitiza os dados para evitar injeção de código
            $medicamento = htmlspecialchars($_POST['medicamento'], ENT_QUOTES);
            $valor = floatval($_POST['valor']);
            $estoque = intval($_POST['estoque']);
            $categoria = htmlspecialchars($_POST['categoria'], ENT_QUOTES);
            $validade = $_POST['validade']; // Assumindo que validade é uma data

            // Prepara e executa a consulta SQL
            $sql = $pdo->prepare("UPDATE medicamentos SET medicamento = :medicamento, valor = :valor, estoque = :estoque, categoria = :categoria, validade = :validade WHERE id = :id");
            $sql->bindValue(':medicamento', $medicamento);
            $sql->bindValue(':valor', $valor);
            $sql->bindValue(':estoque', $estoque);
            $sql->bindValue(':categoria', $categoria);
            $sql->bindValue(':validade', $validade);
            $sql->bindValue(':id', $_POST['id']);

            if ($sql->execute()) {
                // Redireciona para a página de sucesso
                header("Location: sucesso.php");
            } else {
                // Registra o erro em um log (opcional)
                error_log("Erro ao atualizar medicamento: " . $sql->errorInfo()[2]);
                echo "Ocorreu um erro ao atualizar o medicamento. Por favor, tente novamente.";
            }
        }
    }

    // Obtém os dados do medicamento a ser editado
    $id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM medicamentos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $dados = $sql->fetch(PDO::FETCH_ASSOC);

    // Exibe o formulário com os dados pré-preenchidos
    ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $dados['id']; ?>">
        <label for="medicamento">Medicamento:</label>
        <input type="text" name="medicamento" value="<?= $dados['medicamento']; ?>">
        <input type="submit" value="Salvar">
    </form>
</body>
</html>