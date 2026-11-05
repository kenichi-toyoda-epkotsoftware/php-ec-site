<?php

// PHPでSQL文を使うためのパイプ
// このclassを使えば変数としてPDOを受け取れる
class Database
{
    // 初期値でnullを入れる ?はnullでも受け入れる
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
		// DBに接続してなかったら新しく接続
        if (self::$pdo === null) {
            $dsn = 'mysql:host=localhost;dbname=ec_shop2;charset=utf8mb4';
            $username = 'root';
            $password = 'root';

            self::$pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false, // セキュリティ向上のためエミュレートを切る
            ]);
        }

        return self::$pdo;
    }
}