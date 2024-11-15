<?php
require_once '../classes/conect.php';
require_once '../classes/c_livro.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $disponivel = $_POST['disponivel'] ? true : false; // Converte para booleano
    $data_cadastro = $_POST['data_cadastro'];

    // Instanciar o banco de dados e obter a conexão
    $database = new Database();
    $con = $database->getConnection();

    // Habilitar o modo de erro do PDO
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar um novo livro
    // Criar um novo livro
    $livro = new Livro($titulo, $autor, $ano_publicacao, $disponivel, $data_cadastro);

    // Query para inserir o livro no banco de dados
    $query = "INSERT INTO livros (titulo, autor, ano_publicacao, disponivel, data_cadastro)
          VALUES (:titulo, :autor, :ano_publicacao, :disponivel, :data_cadastro)";
    $stmt = $con->prepare($query);

    // Armazenar os valores em variáveis
    $titulo = $livro->getTitulo();
    $autor = $livro->getAutor();
    $ano_publicacao = $livro->getAnoPublicacao();
    $disponivel = $livro->isDisponivel();
    $data_cadastro = $livro->getDataCadastro();

    // Vincular os parâmetros
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':ano_publicacao', $ano_publicacao);
    $stmt->bindParam(':disponivel', $disponivel, PDO::PARAM_BOOL);
    $stmt->bindParam(':data_cadastro', $data_cadastro);


    // Executar a query e verificar se foi bem-sucedida
    try {
        if ($stmt->execute()) {
            echo "Livro cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar livro: A operação não foi bem-sucedida.";
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar livro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Cadastro de Livro</title>
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
    <h1>Cadastrar Livro</h1>
    <form action="" method="post">
        <div class="form-group">
            <label>Título:</label>
            <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="form-group">

        <label>Autor:</label>
        <input type="text" class="form-control" name="autor" required>
        </div>

        <div class="form-group">
        <label>Ano de Publicação:</label>
        <input type="number" class="form-control" name="ano_publicacao" required>
        </div>

        <div class="form-group">
        <label>Disponível:</label>
        <select name="disponivel" class="form-control" required>
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        </div>

        <div class="form-group">
        <label>Data de Cadastro:</label>
        <input type="date" class="form-control" name="data_cadastro" required>
        </div>


        <button type="submit" class="btn btn-primary">Salvar Livros</button>
        <a href="index.php" class="btn btn-secondary">Voltar</a>

    </form>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 WS Livraria. Todos os direitos reservados.</p>
    </footer>
</body>

</html>