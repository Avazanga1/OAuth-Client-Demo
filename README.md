# OAuth-Symfony-Client-Demo

This is demo client application for OAuth2 Server implementation (https://github.com/Avazanga1/OAuth-Server-Demo). It uses https://github.com/hwi/HWIOAuthBundle as OAuth client.


### Installation
1. Clone the repository into local folder on your machine's web server and run symfony project
```sh
$ cd /var/www/html
$ git clone https://github.com/Avazanga1/OAuth-Client-Demo.git oauth_client
$ cd oauth_client
$ composer install
```
2. Copy `parameters.yml.dist` to `parameters.yml`, for installation needs you don't need to set any values now
3. Clear cache and rebuild assets:
```
$ php app/console assetic:dump
$ php app/console cache:clear
```
4. Create virtualhost on you local web serwer:

Sample for Apache 2.4:
```conf
<VirtualHost *:80 >
	ServerAdmin admin@localhost.com
	DocumentRoot "var/www/html/oauth_client/web"
	ServerName ava.client_symfony.local
	
	Header set Access-Control-Allow-Origin *
	Header set Access-Control-Allow-Methods "GET,POST,PUT,OPTIONS"
	Header set Access-Control-Allow-Headers "authorization, Authorization"
	
	ErrorLog "logs/ava.oauth_client_symfony.local-error.log"
	CustomLog "logs/ava.oauth_client_symfony.local-access.log" common
	<directory 	"var/www/html/oauth_client/web">
		AllowOverride All
	</directory>
</VirtualHost>
```

5. Add following line to hosts file:
```
127.0.0.1 ava.client_symfony.local
```
6. Restart your webserver 
