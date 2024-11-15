<?php
require_once '../classes/conect.php';
require_once '../classes/c_livro.php';
require_once 'listar_livros.php';
require_once 'autoload.php';

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto livro 
$livro = new Livro("", "", "", "", "");

// Verifica se o ID do livro foi passado corretamente 
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $livro->setId($_GET['id']);  // Usando o setter para definir o ID

    // Tenta deletar o livro 
    if ($livro->deletar($db, $livro->getId())) {  // Usando o getter para obter o ID
        echo "<script>
            alert('Livro deletado com sucesso');
            window.location.href = 'listar_livros.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao deletar livro.');
            window.location.href = 'listar_livros.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Id do livro não fornecido.');
        window.location.href = 'listar_livros.php';
    </script>";
}
?>
