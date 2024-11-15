<?php
require_once '../classes/conect.php';
require_once '../classes/c_livro.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Função para listar os clientes
function listarLivros($conn)
{
    try {
        // Query para buscar todos os clientes cadastrados
        $query = "SELECT * FROM livros";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Verifica se há registros no banco de dados
        if ($stmt->rowCount() > 0) {
            // Retorna todos os clientes encontrados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    } catch (PDOException $e) {
        echo "Erro ao listar livros: " . $e->getMessage();
        return [];
    }
}

// Chama a função para listar os clientes
$livros = listarLivros($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listar Clientes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
        <h1>Lista de Livros</h1>
        <?php if (count($livros) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano de Publicação</th>
                        <th>Disponível</th>
                        <th>Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livro['id']); ?></td>
                            <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                            <td><?php echo htmlspecialchars($livro['ano_publicacao']); ?></td>
                            <td><?php echo htmlspecialchars($livro['disponivel'] ? 'Sim' : 'Não'); ?></td>
                            <td><?php echo htmlspecialchars($livro['data_cadastro']); ?></td>
                            <td>
                                <!-- Botão para deletar o livro -->
                                <a href="deletar_livro.php?id=<?php echo $livro['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este livro?');">Deletar</a>
                                <a href="editar_livros.php?id=<?php echo $livro['id']; ?>" class="btn btn-primary">Editar</a>
                            </td>
                           

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Nenhum livro cadastrado.</div>
        <?php endif; ?>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 WS Livraria. Todos os direitos reservados.</p>
    </footer>
    
</body>

</html>