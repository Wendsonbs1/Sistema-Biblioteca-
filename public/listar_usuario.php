<?php
require_once '../classes/conect.php';
require_once '../classes/c_usuario.php';

// Criação da conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Função para listar os clientes
function listarClientes($conn)
{
    try {
        // Query para buscar todos os clientes cadastrados
        $query = "SELECT * FROM usuario";
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
        echo "Erro ao listar clientes: " . $e->getMessage();
        return [];
    }
}

// Chama a função para listar os clientes
$clientes = listarClientes($conn);
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
        <h1>Lista de Clientes</h1>
        <?php if (count($clientes) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                            <td>
                                <a href="deletar_usuario.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este usuario?');">Deletar</a>
                                <a href="editar_usuario.php?id=<?php echo $cliente['id']; ?>" class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Nenhum cliente cadastrado.</div>
        <?php endif; ?>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 WS Livraria. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
