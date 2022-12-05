<?php
require_once __DIR__ . '/../../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInput/SignInInput.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInteractor/SignInInteractor.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/Email.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/InputPassword.php';


session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

try {
  if (empty($email) || empty($password)) {
      throw new Exception('パスワードとメールアドレスを入力してください');
  }

  $userEmail = new Email($email);
  $inputPassword = new InputPassword($password);
  $useCaseInput = new SignInInput($email, $password);
  $useCase = new SignInInteractor($useCaseInput);
  $useCaseOutput = $useCase->handler();

  if (!$useCaseOutput->isSuccess()) {
    throw new Exception($useCaseOutput->message());
  }
  redirect('../index.php');
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  redirect('../index.php');
}
?>