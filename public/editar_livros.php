<?php
require_once '../classes/conect.php';
require_once '../classes/c_livro.php';
require_once 'listar_livros.php';
require_once 'autoload.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Verifica se o ID do livro foi passado via GET para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o livro pelo ID
    $livro = new Livro("", "", "", "", "");
    $livro = $livro->buscarPorId($conn, $id);

    // Verifica se o livro existe
    if (!$livro) {
        echo "<div class='alert alert-danger'>Livro não encontrado.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID do livro não fornecido.</div>";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livro->setTitulo($_POST['titulo']);
    $livro->setAutor($_POST['autor']);
    $livro->setAnoPublicacao($_POST['ano_publicacao']);
    $livro->setDisponivel($_POST['disponivel']);
    $livro->setDataCadastro($_POST['data_cadastro']);

    // Atualiza o livro no banco de dados, passando a conexão $conn
    if ($livro->atualizar($conn)) {
        echo "<div class='alert alert-success'>Livro atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o livro.</div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livro->setTitulo($_POST['titulo']);
    $livro->setAutor($_POST['autor']);
    $livro->setAnoPublicacao($_POST['ano_publicacao']);
    $livro->setDisponivel($_POST['disponivel']);

    // Atualiza o livro no banco de dados
    if ($livro->atualizar($conn)) {
        // Redireciona para a lista de livros após a atualização bem-sucedida
        echo "<script>window.location.href = 'listar_livros.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o livro.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Livro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100>
<div class="container mt-5">
    <h1>Atualizar Livro</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>" required>
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($livro->getAutor()); ?>" required>
        </div>
        <div class="form-group">
            <label for="ano_publicacao">Ano de Publicação</label>
            <input type="text" class="form-control" id="ano_publicacao" name="ano_publicacao" value="<?php echo htmlspecialchars($livro->getAnoPublicacao()); ?>" required>
        </div>
        <div class="form-group">
            <label for="disponivel">Disponível</label>
            <select class="form-control" id="disponivel" name="disponivel" required>
                <option value="1" <?php echo $livro->getDisponivel() ? 'selected' : ''; ?>>Sim</option>
                <option value="0" <?php echo !$livro->getDisponivel() ? 'selected' : ''; ?>>Não</option>
            </select>
        </div>
        <div class="form-group">
            <label for="data_cadastro">Data de Cadastro</label>
            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo htmlspecialchars($livro->getDataCadastro()); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="listar_livros.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
