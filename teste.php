<?php
$dsn = "pgsql:host=localhost;port=5432;dbname=loja";

$usuario = "postgres";
$senha = "";

try {
    $pdo = new PDO($dsn, $usuario, $senha);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conectado com sucesso!";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$sql = "INSERT INTO produtos (nome, preco, descricao) 
        VALUES (:n, :p, :d)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':n' => 'Mouse Gamer',
    ':p' => 150.00,
    ':d' => 'Mouse RGB 16000 DPI'
]);

echo "Produto inserido com ID " . $pdo->lastInsertId();

?>