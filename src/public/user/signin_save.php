<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\redirect;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\User\UserAgeDao;
use App\Domain\ValueObject\User\Email;
use App\Domain\ValueObject\User\InputPassword;
use App\UseCase\UseCaseInput\SignInInput;
use App\UseCase\UseCaseInteractor\SignInInteractor;
use App\Adapter\QueryServise\UserQueryServise;

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

try {
  if (empty($email) || empty($password)) {
      throw new Exception('パスワードとメールアドレスを入力してください');
  }
  $userEmail = new Email($email);
  $inputPassword = new InputPassword($password);
  $useCaseInput = new SignInInput($userEmail, $inputPassword);
  $userDao = new UserDao();
  $userAgeDao = new UserAgeDao();
  $queryServise = new UserQueryServise($userDao, $userAgeDao);
  $useCase = new SignInInteractor($useCaseInput, $queryServise);
  $useCaseOutput = $useCase->handler();

  if (!$useCaseOutput->isSuccess()) {
    throw new Exception(
        'メールアドレスまたは<br/>パスワードが間違っています'
    );
  }
  redirect('../index.php');
} catch (Exception $e) {
  session_start();
  $_SESSION['errors'][] = $e->getMessage();
  redirect('signin.php');
}
?>