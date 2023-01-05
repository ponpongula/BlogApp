<?php
require_once __DIR__ . '/../../app/Domain/ValueObject/User/UserName.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/User/Email.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/User/InputPassword.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/User/Age.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInput/SignUpInput.php';
require_once __DIR__ . '/../../app/Adapter/QueryServise/UserQueryServise.php';
require_once __DIR__ . '/../../app/Adapter/Repository/UserRepository.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInteractor/SignUpInteractor.php';
require_once __DIR__ . '/../../app/Infrastructure/Redirect/redirect.php';


$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
$age = filter_input(INPUT_POST, 'age');

try {
  session_start();
  if (empty($name) || empty($email)) {
     throw new Exception('ユーザーネームとメールアドレスを入力してください');
  }
  if (empty($password) || empty($confirmPassword)) {
      throw new Exception('パスワードを入力してください');
  }
  if ($password !== $confirmPassword) {
      throw new Exception('パスワードが一致しません');
  }

  $userName = new UserName($name);
  $userEmail = new Email($email);
  $userPassword = new InputPassword($password);
  $userAge = new Age($age);
  $useCaseInput = new SignUpInput(
      $userName,
      $userEmail,
      $userPassword,
      $userAge
  );
  $userDao = new UserDao();
  $userAgeDao = new UserAgeDao();
  $queryServise = new UserQueryServise($userDao, $userAgeDao);
  $repository = new UserRepository();
  $useCase = new SignUpInteractor($useCaseInput, $queryServise, $repository);
  $useCaseOutput = $useCase->handler();

  if (!$useCaseOutput->isSuccess()) {
    throw new Exception('すでに登録済みのメールアドレスです');
  }
  $_SESSION['message'] = '登録が完了しました';
  redirect('signin.php');
} catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['age'] = $age;
    redirect('signup.php');
}
?>