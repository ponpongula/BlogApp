<?php
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
     * @param  string $user_id
     * @param　string $blog_id
     * @param　string $commenter_name
     * @param　string $comments
     */
    public function create(string $user_id, string $blog_id, string $commenter_name, string $comments): void
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
      $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
      $statement->bindValue(':blog_id', $blog_id, PDO::PARAM_STR);
      $statement->bindValue(':commenter_name', $commenter_name, PDO::PARAM_STR);
      $statement->bindValue(':comments', $comments, PDO::PARAM_STR);
      $statement->execute();
    }


    /**
     * ブログのコメントを取得する
     * @param  string $user_id
     * @return array $comments
     */

    public function fetchAllByBlogId(string $id): array
    {
      $sql = sprintf(
        "SELECT * FROM %s WHERE blog_id = :blog_id",
        self::TABLE_NAME
      );
      $statement = $this->pdo->prepare($sql);
      $statement->bindValue(':blog_id', $id, PDO::PARAM_STR);
      $statement->execute();
      $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $comments;
    }
}
?>