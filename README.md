# confirmation_test_contact-form

## Environment / 実行環境
- Virtualization / 仮想化環境:Docker / Docker Compose
- php: 8.1 
- Laravel: 8.83.8
- mysql: 8.0.26
- phpmyadmin
- nginx: 1.21.1

## Setup Instructions / 環境構築
1. Clone the repository / リポジトリクローン  
 ```git clone git@github.com:ruigorou/confirmation_test.git```  
 ```cd confirmation_test```
2. Build and Start Docker Containers / Dockerコンテナのビルドと起動
```docker-compose up -d --build```

## Laravel Setup / Laravel環境構築
1. Install Laravel Packages / Laravelパッケージのインストール  
 ```docker-compose exec php bash```  
 ```composer install```
2. Create Environment File /　環境変数の作成(.envファイルの作成)  
```cp .env.example .env```
3. Generate Application Key /　アプリケーションキーの生成  
```php artisan key:generate```

## Database Migration / マイグレーション
1. Create a Migration File /マイグレーションファイルの作成  
```php artisan make:migration create_[テーブル名]_table```
2. Run Migrations / マイグレーション実行  
```php artisan migrate```
### Reset Migrations (All data will be deleted) / マイグレーションのやり直し(※データが削除されます) 
1. マイグレーションファイルのロールバックとマイグレートを一度に行う  
```php artisan migrate:fresh```
2. マイグレーション実行  
```php artisan migrate```

## Seeding / シーデング 
1. Create a Seeder File / シーダーファイルの作成  
```php artisan make:seeder シーダ名```
2. Run Seeder / シーデングの実行  
```php artisan db:seed```
3. Check that the seeder file was created via phpMyAdmin / phpMyAdminでシーディング結果を確認  
[http://localhost:8080](http://localhost:8080)

## Application URLs (Development Environment) / url(開発環境)
- Contact Form / お問い合わせ画面：http://localhost
- User Registration / ユーザー登録：http://localhost/register
- phpmyadmin：http://localhost:8080

## ER Diagram / ER図
![ER図](src/docs/er.drawio.png)



