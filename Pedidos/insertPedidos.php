<?php
session_start();
$cliente_id = $_POST['cliente_id'] ?? '';
$data_pedido = $_POST['data_pedido'] ?? '';
$status = $_POST['status'] ?? '';


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

$sql = "INSERT INTO pedidos (cliente_id,data_pedido,status) 
        VALUES (:n, :p, :d)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':n' => $cliente_id,
    ':p' => $data_pedido,
    ':d' => $status
]);

echo "pedido inserido com id " . $pdo->lastInsertId();

?>