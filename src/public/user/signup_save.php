<?php
require_once __DIR__ . '/../../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInput/SignUpInput.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInteractor/SignUpInteractor.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/UserName.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/Email.php';
require_once __DIR__ . '/../../app/Domain/ValueObject/InputPassword.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

try {
  session_start();
  if (empty($password) || empty($confirmPassword)) {
      throw new Exception('パスワードを入力してください');
  }
  if ($password !== $confirmPassword) {
      throw new Exception('パスワードが一致しません');
  }

  $userName = new UserName($name);
  $userEmail = new Email($email);
  $userPassword = new InputPassword($pawssord);
  $useCaseInput = new SignUpInput($name, $email, $password);
  $useCase = new SignUpInteractor($useCaseInput);
  $useCaseOutput = $useCase->handler();

  if (!$useCaseOutput->isSuccess()) {
      throw new Exception($useCaseOutput->message());
  }
  $_SESSION['errors'][] = $useCaseOutput->message();
  redirect('signin.php');
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  $_SESSION['formInputs']['name'] = $name;
  $_SESSION['formInputs']['email'] = $email;
  redirect('signup.php');
}
?>