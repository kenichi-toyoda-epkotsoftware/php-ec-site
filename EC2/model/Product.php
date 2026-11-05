<?php

class Product
{
    private PDO $pdo;

    // new Product($pdo);こんな感じで指定できる
    public function __construct(PDO $pdo)
    {
        // 特定のDBのパイプを持ってきて
        // モデル内で使うことができる
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM product ORDER BY id');
        $product_list = $stmt->fetchAll();

        return $product_list;
    }
    
    public function create(string $name, string $price, string $gazou): bool
    {
        $sql = 'INSERT INTO product (name, price, gazou) VALUES (:name, :price, :gazou)';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name'     => $name,
            ':price'    => $price,
            ':gazou'    => $gazou,
        ]);
    }

    public function findById($id): array
    {
        $sql = 'SELECT id, name, price, gazou FROM product WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $pro = $stmt->fetch(PDO::FETCH_ASSOC);

        return $pro;
    }

    public function update(string $name, $price, $gazou, $id)
    {

        $sql = 'UPDATE product SET name = :name, price = :price , gazou = :gazou WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name'     => $name,
            ':price'    => $price,
            ':gazou'    => $gazou,
            ':id'       => $id
        ]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM product WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function math(array $cart, array $products): int
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $pId = $product['id'];
            $qty = $cart[$pId] ?? 0;
            $totalPrice += $product['price'] * $qty;
        }
        return $totalPrice;
    }
}

/*
$_SESSION['cart'] = [
    1 => 3,  // 商品ID 1 が 合計 3個 (最初に2個 + 追加で1個)
    4 => 1   // 商品ID 4 が 1個
];
*/