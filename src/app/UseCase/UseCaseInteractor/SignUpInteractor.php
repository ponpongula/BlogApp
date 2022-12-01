<?php
require_once __DIR__ . '/../UseCaseInput/SignUpInput.php';
require_once __DIR__ . '/../UseCaseOutput/SignUpOutput.php';
require_once __DIR__ . '/../../Infrastructure/Dao/UserDao.php';

final class SignUpInteractor
{
    const ALLREADY_EXISTS_MESSAGE = 'すでに登録済みのメールアドレスです';
    const COMPLETED_MESSAGE = '登録が完了しました';

    private $useCaseInput;
     
    public function __construct(SignUpInput $useCaseInput)
    {
        $this->useCaseInput = $useCaseInput;
    }
    
    public function handler(): SignUpOutput
    {
        $userDao = new UserDao();
        $user = $userDao->findByEmail($this->useCaseInput->email());
        
        if (!is_null($user)) {
            return new SignUpOutput(false, self::ALLREADY_EXISTS_MESSAGE);
        }
        
        $userDao->create(
            $this->useCaseInput->name(),
            $this->useCaseInput->email(),
            $this->useCaseInput->password()
        );
        return new SignUpOutput(true, self::COMPLETED_MESSAGE);
    }
}
?>