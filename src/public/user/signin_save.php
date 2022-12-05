<?php
require_once __DIR__ . '/../../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInput/SignInInput.php';
require_once __DIR__ . '/../../app/UseCase/UseCaseInteractor/SignInInteractor.php';

session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

if (empty($email) || empty($password)) {
  $_SEESION['errors'][] = 'パスワードとメールアドレスを入力してください';
  redirect('signin.php');
}
$useCaseInput = new SignInInput($email, $password);
$useCase = new SignInInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();
if ($useCaseOutput->isSuccess()) {
  redirect('../index.php');
} else {
  $_SESSION['errors'][] = $useCaseOutput->message();
  redirect('signin.php');
}
?>