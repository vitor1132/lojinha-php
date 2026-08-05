<?php
session_start();
$nome_produto = $_POST['nome_produto'] ?? '';
$preco = $_POST['preco'] ?? '';
$estoque = $_POST['estoque'] ?? '';
$marca_id = $_POST['marca_id'] ?? '';


$dsn = "pgsql:host=localhost;port=5432;dbname=lojinha";

$usuario = "postgres";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conectado com sucesso!";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$sql = "INSERT INTO produtos (nome_produto, preco,estoque,marca_id) 
        VALUES (:n, :p, :d, :l)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':n' => $nome_produto,
    ':p' => $preco,
    ':d' => $estoque,
    ':l' => $marca_id
]);

echo "produto inserido com id " . $pdo->lastInsertId();

?>