# BLogApp
ブログを投稿し閲覧、<br>
コメントすることができます

## 機能一覧

- ユーザー登録、ログイン機能

 ※ユーザー登録、ログイン機能のみテールウインドを使用しております

- 投稿機能

- 投稿削除機能

- 投稿編集機能

- コメント機能

- 検索機能

- ソート機能

### データベース設計

※デプロイ後の機能追加を想定し、NULLの許容を防ぐため別でuser_ageテーブルを作成しました。
![Editing BlogApp_README md at main · ponpongula_BlogApp - Google Chrome 2023_04_01 14_02_04](https://user-images.githubusercontent.com/92622872/229266600-25278b48-061b-4bd0-90a1-b6c51a6c499d.png)

## DDD化
User機能のDDD化のみ完成していて、<br>
Blog機能、Comment機能は、はEntity、QueryService、Repositoryの作成は飛ばしております。

## 環境構築

### 「Dockerコンテナ」の起動

```
./docker-compose-local.sh up
```

## ページ紹介

php

[localhost:8080](http://localhost:8080)

PHPMyAdmin

[localhost:3306](http://localhost:3306)
