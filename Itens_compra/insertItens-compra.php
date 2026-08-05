<?php
session_start();
$pedido_id = $_POST['pedido_id'] ?? '';
$produto_id = $_POST['produto_id'] ?? '';
$quantidade = $_POST['quantidade'] ?? '';
$preco_unitario = $_POST['preco_unitario'] ?? '';


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

$sql = "INSERT INTO itens_compra (pedido_id,produto_id,quantidade,preco_unitario) 
        VALUES (:n, :p, :d, :l)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':n' => $pedido_id,
    ':p' => $produto_id,
    ':d' => $quantidade,
    ':l' => $preco_unitario
]);

echo "compra inserida ";

?>