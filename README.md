# 基礎学習ターム確認テスト_もぎたて

## 環境構築
```
リポジトリからダウンロード
git clone git@github.com:pao590/tao-kadai2.git

---
.envファイルの作成と設定
cp .env.example .env

---
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
---

Dockerコンテナの構築と起動
docker-compose up -d --build

---
PHPコンテナ起動
docker-compose exec app bash
---

composerのインストール
composer install

---
アプリケーションキーの生成
php artisan key:generate

---
ストレージのシンボリック作成
php artisan storage:link

---
マイグレーションとシーディングの実行
php artisan migrate
php artisan db:seed


## 使用技術
- PHP 7.4.9
- Laravel 8.83.29
- MySQL 8.0.26
- Docker 27.4.0

## ER図
![ER図](ER.drawio.png)

## URL
- 開発環境：http://localhost/
