# Projeto para sênior backend PHP (v1.1)
* É necessário fazer login para obter a hash para explorar os serviços da aplicação.
ip:0000/api/v1/login

Nessa rota você receberar um token o qual tem que ser utilizado no Authorization
TYPE Bearer Token

# Capacidades não atendidas.
Diferencial:
- Criar o ambiente usando docker e se preferir usar docker-compose também para os
serviços do php e banco de dados.
* Tive problemas com permissão do docker em meu ambiente, terei de explorar. Breve verifico e subo um yml

## Capacidades a ser mais exploradas.
 * Testes
 * Preciso explorar mais os testes quando envolvido a autenticação JWT
## Executar filas
php artisan queue:work

## Bug durante o desenvolvimento
-----------------------------------------------------------------------------------------------------------------------------------------
"} 
[2022-12-17 02:22:31] local.ERROR: Trait 'Illuminate\Foundation\Auth\RegistersUsers' not found {"exception":"[object] (Symfony\\Component\\ErrorHandler\\Error\\FatalError(code: 0): Trait 'Illuminate\\Foundation\\Auth\\RegistersUsers' not found at /media/fabricio/hdExt/projetos_ps/doctor-test/app/Http/Controllers/Api/RegisterController.php:16)
[stacktrace]
#0 {main}
"} 

composer require laravel/ui
----------------------------------------------------------------------------------------------------------------------------------------

# implement erro, colar o namespace direto no VENDOR/JWT para instanciar na aplicação
doctor-test/vendor/tymon/jwt-auth/src/Contracts/JWTSubject.php

* Importante ressaltar que a lib JWT tem alguns erros quando aplicado as configurações. O interessante que  composer
Parece não consegui registrar o serviço na aplicação, isso é um ponto a ser mantido e explorado para demais projetos futuros.
