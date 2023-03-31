<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Infrastructure\Dao\UserDao;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\Email;
use App\Domain\ValueObject\User\InputPassword;
use App\Domain\ValueObject\User\Age;
use App\UseCase\UseCaseInput\SignUpInput;
use App\UseCase\UseCaseInteractor\SignUpInteractor;
use App\Adapter\QueryServise\UserQueryServise;
use App\Adapter\Repository\UserRepository;

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
$age = filter_input(INPUT_POST, 'age');

session_start();
try {
  if (empty($name) || empty($email) || empty($age)) {
     throw new Exception('ユーザーネームとメールアドレスと年齢を入力してください');
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
  $repository = new UserRepository($userDao, $userAgeDao);
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