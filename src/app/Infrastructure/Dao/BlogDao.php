<?php
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogSearchWord.php';
require_once __DIR__ . '/../../Domain/ValueObject/Blog/BlogSortOrder.php';
/**
 * ブログ情報を操作するDAO
 */
final class BlogDao
{
  const TABLE_NAME = 'blogs';
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
     * ブログ一覧を取得する
     * @param  string | null
     * @param  string | null
     * @return　array $blogs
     */
  public function getBlogList(BlogSearchWord $searchWord, ?BlogSortOrder $sortOrder): array
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE title LIKE :searchWord OR content LIKE :searchWord ORDER BY created_at",
      self::TABLE_NAME
    );
    $sql  = $sql . serialize($sortOrder);
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(":searchWord", '%' . $searchWord . '%');
    $statement->execute();
    $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blogs;
  }

  /**
   * ブログの値を取得する
   * @param  string $id
   * @return　array | null
   */
  public function edit(BlogId $id): ?array
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE id = :id",
      self::TABLE_NAME
    );
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $blog = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blog;
  }

  /**
   * ブログ編集を保存する
   * @param  string $id
   * @param　string $title
   * @param　string $content
   */
  public function update(BlogId $id, BlogTitle $title, BlogContent $content): void
  {
    $sql = sprintf(
      "UPDATE %s SET title = :title, content = :content WHERE id = :id",
      self::TABLE_NAME
    );
    $statement = $this->pdo->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->execute();
  }

  /**
   * ユーザーの情報を取得する
   * @param  string $user_id
   * @return　array $blogs
   */
  public function fetchAllByUserId(UserId $user_id): array
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE user_id = :user_id",
      self::TABLE_NAME
    );
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blogs;
  }

  /**
   * ブログを保存する
   * @param  string $user_id
   * @param　string $title
   * @param　string $content
   */
  public function create(UserId $user_id, BlogTitle $title, BlogContent $content): void
  {
    $sql = sprintf(
      "INSERT INTO %s (user_id, title, content) VALUES (:user_id, :title, :content)",
      self::TABLE_NAME
    );
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':content', $content, PDO::PARAM_STR);
    $statement->execute();
  }

  public function delete(BlogId $id): void
  {
    $sql = sprintf(
      "DELETE FROM %s WHERE id = :id",
      self::TABLE_NAME
    );
    $statement = $this->pdo->prepare($sql);
    $statement->v(':id', $id, PDO::PARAM_STR);
    $statement->execute();
  }
}
?>