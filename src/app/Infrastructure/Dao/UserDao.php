<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\NewUser;
use App\Domain\ValueObject\User\Email;

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

    /**
     * コンストラクタ
     * @param PDO $pdo
     */
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
     * @param  NewUser $user
     */
    public function create(NewUser $user): void
    {
        $hashedPassword = $user->password()->hash();

        $sql = sprintf(
            'INSERT INTO %s (name, email, password) VALUES (:name, :email, :password)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $user->name()->value(), PDO::PARAM_STR);
        $statement->bindValue(':email', $user->email()->value(), PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword->value(), PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * emailの有無を検索する
     * @param  Email $email
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

    /**
     * useridの有無を検索する
     * @param  UserId $user
     * @return array | null
     */
    public function findByUserId(UserId $user): ?array
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $user->value(), PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $user ? $user : null;
    }
}
