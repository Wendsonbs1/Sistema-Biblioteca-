<?php
require_once '../classes/conect.php';
require_once '../classes/c_usuario.php';
require_once 'listar_usuario.php';
require_once 'autoload.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Verifica se o ID do usuário foi passado via GET para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o usuário pelo ID
    $usuario = new Usuario(0, "", "", "", "");
    $usuario = $usuario->buscarPorId($conn, $id);

    // Verifica se o usuário existe
    if (!$usuario) {
        echo "<div class='alert alert-danger'>Usuário não encontrado.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID do usuário não fornecido.</div>";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario->setNome($_POST['nome']);
    $usuario->setCpf($_POST['cpf']);
    $usuario->setEndereco($_POST['endereco']);
    $usuario->setTelefone($_POST['telefone']);

    // Atualiza o usuário no banco de dados, passando a conexão $conn
    if ($usuario->atualizar($conn)) {
        echo "<div class='alert alert-success'>Usuário atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o usuário.</div>";
    }
}

if ($livro->atualizar($conn)) {
    // Redireciona para a lista de livros após a atualização bem-sucedida
    echo "<script>window.location.href = 'listar_usuario.php';</script>";
    exit;
} else {
    echo "<div class='alert alert-danger'>Erro ao atualizar usuários.</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Atualizar Usuário</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario->getNome()); ?>" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($usuario->getCpf()); ?>" required>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario->getEndereco()); ?>" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario->getTelefone()); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="listar_usuarios.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>