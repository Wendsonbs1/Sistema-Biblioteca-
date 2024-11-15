<?php
class Usuario {
    private $id;
    private $nome;
    private $cpf;
    private $endereco;
    private $telefone;

    // Construtor da classe
    public function __construct($id, $nome, $cpf, $endereco, $telefone) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
    }

    // Métodos Get e Set para os atributos

    // Getters e Setters para o id
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    // Getters e Setters para o nome
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    // Getters e Setters para o cpf
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }

    // Getters e Setters para o endereco
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    // Getters e Setters para o telefone
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    // Método para salvar o usuário no banco de dados
    public function salvar($con) {
        try {
            // Prepara a query SQL
            $query = "INSERT INTO usuario (id, nome, cpf, endereco, telefone) 
                      VALUES (:id, :nome, :cpf, :endereco, :telefone)";
            $stmt = $con->prepare($query);

            // Vincula os parâmetros com os valores dos atributos da classe
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':endereco', $this->endereco);
            $stmt->bindParam(':telefone', $this->telefone);

            // Executa a query
            if ($stmt->execute()) {
                return true; // Sucesso
            } else {
                return false; // Falha
            }
        } catch (PDOException $e) {
            // Exibe a mensagem de erro, caso ocorra
            echo "Erro ao salvar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function deletar($con, $id) {
        $query = "DELETE FROM usuario WHERE id = :id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function buscarPorId($conn, $id) {
        $query = "SELECT * FROM usuario WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                $this->nome = $row['nome'];
                $this->cpf = $row['cpf'];
                $this->endereco = $row['endereco'];
                $this->telefone = $row['telefone'];
                
                return $this;
            }
        }
        return false;
    }

    // Método para atualizar os dados do usuário
    public function atualizar($conn) {
        $query = "UPDATE usuario SET nome = :nome, cpf = :cpf, endereco = :endereco, telefone = :telefone WHERE id = :id";
        $stmt = $conn->prepare($query);
        
        // Vincula os parâmetros aos atributos da classe
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':endereco', $this->endereco);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}

?>
