<?php
class Livro
{
    private $id;
    private $titulo;
    private $autor;
    private $ano_publicacao;
    private $disponivel;
    private $data_cadastro;

    public function __construct($titulo, $autor, $ano_publicacao, $disponivel, $data_cadastro)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano_publicacao = $ano_publicacao;
        $this->disponivel = $disponivel;
        $this->data_cadastro = $data_cadastro;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getAnoPublicacao() {
        return $this->ano_publicacao;
    }

    public function setAnoPublicacao($ano_publicacao) {
        $this->ano_publicacao = $ano_publicacao;
    }

    public function isDisponivel() {
        return $this->disponivel;
    }

    public function getDisponivel(){
        return $this->disponivel;
    }

    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }

   public function setDataCadastro($data_cadastro){
        $this->data_cadastro = $data_cadastro;
   }

    public function setIndisponivel() {
        $this->disponivel = false;
    }
    
    public function deletar($con, $id) {
        // Query para excluir o livro do banco de dados
        $query = "DELETE FROM livros WHERE id = :id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Executa a query
        return $stmt->execute();
    }
    
    public function buscarPorId($conn, $id) {
        $query = "SELECT * FROM livros WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                $this->titulo = $row['titulo'];
                $this->autor = $row['autor'];
                $this->ano_publicacao = $row['ano_publicacao'];
                $this->disponivel = $row['disponivel'];
                $this->data_cadastro = $row['data_cadastro'];
                
                return $this;
            }
        }
        return false;
    }

    // Método para atualizar os dados de um livro
    public function atualizar($conn) {
        $query = "UPDATE livros SET titulo = :titulo, autor = :autor, ano_publicacao = :ano_publicacao, disponivel = :disponivel, data_cadastro = :data_cadastro WHERE id = :id";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':ano_publicacao', $this->ano_publicacao);
        $stmt->bindParam(':disponivel', $this->disponivel);
        $stmt->bindParam(':data_cadastro', $this->data_cadastro);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
}
?>
