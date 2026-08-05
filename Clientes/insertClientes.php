<?php
session_start();
$nome_cliente = $_POST['nome_cliente'] ?? '';
$email   = $_POST['email'] ?? '';
$cidade = $_POST['cidade'] ?? '';





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

$sql = "INSERT INTO clientes (nome_cliente, email, cidade) 
        VALUES (:n, :p, :d)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':n' => $nome_cliente,
    ':p' => $email,
    ':d' => $cidade
]);

echo "cliente inserido com id " . $pdo->lastInsertId();

?>