<?php
require_once __DIR__ . '/../../Domain/ValueObject/User/NewUser.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/Email.php';
/**
 * ユーザー情報を操作するDAO
 */
final class UserDao
{
    /**
     * DBのテーブル名
     */
    const TABLE_NAME = 'users';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=blog;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch (PDOException $e) {
            exit('DB接続エラー:' . $e->getMessage());
        }
    }

    /**
     * ユーザーを追加する
     * @param  string $name
     * @param  string $mail
     * @param  string $password
     */
    public function create(NewUser $user): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = sprintf(
            'INSERT INTO %s (name, email, password) VALUES (:name, :email, :password)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * emailの有無を検索する
     * @param  string $email
     * @return array | null
     */
    public function findByEmail(Email $email): ?array
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE email = :email',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':email', $email->value(), PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $user ? $user : null;
    }
}