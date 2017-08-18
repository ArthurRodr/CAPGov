# CAPGovCrud

- Utilizado WAMPSERVER 3.0.6

- Versão Apache 2.4.23

- Versão PHP 7.0.10

- Versão PostgreSQL9.6(x86)

- Laravel Installer 1.3.7


Link para download do WAMP: https://ufpr.dl.sourceforge.net/project/wampserver/WampServer%203/WampServer%203.0.0/wampserver3.0.6_x64_apache2.4.23_mysql5.7.14_php5.7.14-7.0.10.exe

Ao utilizar o WAMP:

Em php extensions (podem ser descomentadas em php.ini):
- Ativar php_pdo_pgsql
- Ativar php_pgsql

Em apache modules:
- Verificar se rewrite_module está ativo

Em httpd.conf no apache tive que mudar a porta para 8081, 
porque estava dando conflito de portas para rodar o sistema. Para isso altere em httpd.conf: 

em :

Listen 80

altere para:

Listen 8081

e em :

ServerName localhost:80

altere para:

ServerName localhost:8081

Após isso, para rodar o sistema tive que rodar no cmd, na pasta root do projeto:

php artisan serve --port=80
















