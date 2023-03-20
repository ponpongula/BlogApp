<?php
require_once __DIR__ . '/../../Domain/ValueObject/User/UserId.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogId.php';
require_once __DIR__ . '/../../Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogComment.php';

/**
 * コメント情報を操作するDAO
 */
final class CommentDao
{
    const TABLE_NAME = 'comments';
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
     * コメントを作成する
     * @param  UserId $user_id
     * @param　BlogId $blog_id
     * @param　UserName $commenter_name
     * @param　BlogComment $comment
     */
    public function create(UserId $user_id, BlogId $blog_id, UserName $commenter_name, BlogComment $comment): void
    {
      
      $sql = sprintf(
        "INSERT INTO 
        %s
          (user_id, blog_id, commenter_name, comments) 
        VALUES 
          (:user_id, :blog_id, :commenter_name, :comments)",
        self::TABLE_NAME
      );
      $statement = $this->pdo->prepare($sql);
      $statement->bindValue(':user_id', $user_id->value(), PDO::PARAM_STR);
      $statement->bindValue(':blog_id', $blog_id->value(), PDO::PARAM_STR);
      $statement->bindValue(':commenter_name', $commenter_name->value(), PDO::PARAM_STR);
      $statement->bindValue(':comments', $comment->value(), PDO::PARAM_STR);
      $statement->execute();
    }


    /**
     * ブログのコメントを取得する
     * @param  BlogId $blog_id
     * @return array $comments
     */

    public function fetchAllByBlogId(BlogId $blog_id): array
    {
      $sql = sprintf(
        "SELECT * FROM %s WHERE blog_id = :blog_id",
        self::TABLE_NAME
      );
      $statement = $this->pdo->prepare($sql);
      $statement->bindValue(':blog_id', $blog_id->value(), PDO::PARAM_STR);
      $statement->execute();
      $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $comments;
    }
}
?>