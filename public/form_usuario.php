<?php
require_once '../classes/conect.php';
require_once '../classes/c_usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    // Instanciar o banco de dados e obter a conexão
    $database = new Database();
    $con = $database->getConnection();

    // Criar um novo usuário
    $usuario = new Usuario(null, $nome, $cpf, $endereco, $telefone);

    // Salvar o usuário no banco de dados
    if ($usuario->salvar($con)) {
        echo "Usuário salvo com sucesso!";
    } else {
        echo "Erro ao salvar o usuário.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>

    <title>Cadastro de Cliente</title>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <div class="container">
            <div class="org">
                <div class="logo">
                    <img src="img/livro.webp" alt="">
                </div>
                <div class="logo">

                    <h1>WS Livraria</h1>
                </div>
            </div>


            <div class="search-bar">
                <input type="text" placeholder="Pesquisar...">
                <button type="button">Buscar</button>
            </div>
        </div>
    </header>
    <div class="container mt-5">
    <h1>Cadastrar Cliente</h1>

    <form action="" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" class="form-control" required><br><br>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 WS Livraria. Todos os direitos reservados.</p>
    </footer>
</body>

</html>