<?php
require_once __DIR__ . '/../../app/Domain/ValueObject/User/Email.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/User/InputPassword.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInput/SignInInput.php';
require_once __DIR__ . '/../../app/Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../app/Infrastructure/Dao/UserAgeDao.php';
require_once __DIR__ . '/../../app/Adapter/QueryServise/UserQueryServise.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInteractor/SignInInteractor.php';
require_once __DIR__ . '/../../app/Infrastructure/Redirect/redirect.php';

session_start();
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
        'メールアドレスまたは<br />パスワードが間違っています'
    );
  }
  redirect('../index.php');
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  redirect('signin.php');
}
?>