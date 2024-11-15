<?php
require_once '../classes/conect.php';
require_once '../classes/c_usuario.php';

// Instancia a conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto usuario
$usuario = new Usuario("", "", "", "", "");

// Verifica se o ID do usuário foi passado corretamente
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $usuario->setId($_GET['id']);  // Usando o setter para definir o ID

    // Tenta deletar o usuário
    if ($usuario->deletar($db, $usuario->getId())) {  // Usando o getter para obter o ID
        echo "<script>
            alert('Usuário deletado com sucesso');
            window.location.href = 'listar_usuario.php';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao deletar usuário.');
            window.location.href = 'listar_usuario.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Id do usuário não fornecido.');
        window.location.href = 'listar_usuario.php';
    </script>";
}
?>
