<?php
require_once __DIR__ . '/../../Infrastructure/Dao/CommentDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/BlogDao.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../UseCaseInput/CommentInput.php';
require_once __DIR__ . '/../UseCaseOutput/CommentOutput.php';

/**
 * コメントユースケース
 */
final class CommentInteractor
{
    /**
     * @var CommentInput
     */
    private $input;

    /**
     * @var CommentDao
     */
    private $commentDao;

    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * @var BlogDao
     */
    private $blogDao;

    /**
     * コンストラクタ
     * @param CommentInput $input
     * @param CommentDao $commentDao
     * @param UserDao $userDao
     * @param BlogDao $BlogDao
     */
    public function __construct(
        CommentInput $input,  
        CommentDao $commentDao, 
        UserDao $userDao, 
        BlogDao $blogDao
    ) {
        $this->input = $input;
        $this->commentDao = $commentDao;
        $this->userDao = $userDao;
        $this->blogDao = $blogDao;
    }

    /**
     * 登録処理
     * ユーザーとブログの有無の確認も行う
     * @return CommentOutput
     */
    public function handler(): CommentOutput
    {
        $user_id = $this->findUser();
        $blog_id = $this->findBlog();

        if (empty($user_id) || empty($blog_id)) {
             return new CommentOutput(false);
        }

        $this->commentDao->create(
            $this->input->user_id(), 
            $this->input->blog_id(), 
            $this->input->commenter_name(),
            $this->input->comment()
        );
    
        return new CommentOutput(true);
    }

    /**
     * ユーザーが存在するかで検索する
     *
     * @return array | null
     */
    private function findUser(): ?array
    {
        return $this->userDao->findByUserId($this->input->user_id());
    }

    /**
     * ブログが存在するかで検索する
     *
     * @return array | null
     */
    private function findBlog(): ?array
    {
        return $this->blogDao->findByBlogId($this->input->blog_id());
    }
}