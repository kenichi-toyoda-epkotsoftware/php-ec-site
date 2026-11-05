<?php

class User
{
    private PDO $pdo;

    // new User($pdo);こんな感じで指定できる
    public function __construct(PDO $pdo)
    {
        // 特定のDBのパイプを持ってきて
        // モデル内で使うことができる
        $this->pdo = $pdo;
    }

    // このメソッドはnullか配列を返す
    public function authenticate(string $name, string $pass): ?array
    {
        $sql = 'SELECT id, name, pass FROM staff WHERE name = :name LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        // // PDO::PARAM_STRこれはPHPとDBに変数は文字列と伝えてる
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        // ['id' => 1,'name' => 'とよだ','pass']
        $user = $stmt->fetch();


        // ユーザーが存在し、ハッシュ化されたpassが一致するか
        if ($user && password_verify($pass, $user['pass'])) {
            return $user; // 成功時はユーザー配列を返す
        }

        return null; // 失敗時はnullを返す
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM staff ORDER BY id');
        $staff_list = $stmt->fetchAll();

        return $staff_list;
    }

    public function findById(int $id): array
    {
        $sql = 'SELECT id, name, pass FROM staff WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $staff = $stmt->fetch(PDO::FETCH_ASSOC);

        return $staff;
    }

    public function create(string $name, string $pass): bool
    {
        $sql = 'INSERT INTO staff (name, pass) VALUES (:name, :password)';
        $stmt = $this->pdo->prepare($sql);

        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':name'     => $name,
            ':password' => $hashedPass,
        ]);
    }

    public function update(string $name, $pass, $id)
    {

        $sql = 'UPDATE staff SET name = :name, pass = :pass WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':name'     => $name,
            ':pass'     => $hashedPass,
            ':id'       => $id
        ]);
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM staff WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}