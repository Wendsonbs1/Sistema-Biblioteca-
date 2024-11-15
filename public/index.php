<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Biblioteca</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- CSS Personalizado -->
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
        <h1>Sistema de Biblioteca</h1>
        <ul class="list-group">
            <li class="list-group-item"><a href="form_usuario.php">Cadastrar Cliente</a></li>
            <li class="list-group-item"><a href="listar_usuario.php">Listar Clientes</a></li>
            <li class="list-group-item"><a href="form_livro.php">Cadastrar Livro</a></li>
            <li class="list-group-item"><a href="listar_livros.php">Listar Livros</a></li>
            <!-- Adicione outros links conforme necessário -->
        </ul>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 WS Livraria. Todos os direitos reservados.</p>
    </footer>
</body>

</html>