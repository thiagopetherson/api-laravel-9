# Teste SOLUTTI

Projeto de um sistema de cadastro de lojas e produtos onde são feitas todas as etapas de um CRUD: Create, Read, Update e Delete.


## 🚀 Detalhes


Desenvolvimento de uma API em Laravel 9 com duas tabelas que se relacionam (Has Many): Tabelas stores (lojas) e products (produtos). Eu segui o padrão de nomenclatura das tabelas e campos em inglês.

A tabela stores possui os campos (id, name, email, created_at e updated_at). 
A tabela products possui os campos (id, store_id, name, value, active, created_at e updated_at)


## 🛠️ Pré-requisitos


Você precisa ter instalado em sua máquina:

- Composer<br/>
- Laravel<br/>


## 📋 Guia para instalação

Composer e Laravel 

`https://blog.codeexpertslearning.com.br/instalando-laravel-installer-no-windows-3bbf352367d2`

<br/>


## 📦 Desenvolvimento Backend (Ferramentas utilizadas na API Laravel)

Rotas e Métodos Resources.<br/>
Métodos de Relacionamentos Has Many - Joins de Tabelas<br/>
Mutator - Usamos para máscara de saída<br/>
Form Requests - Validação<br/>
Helpers - Reutilização e Clean Code<br/>


## 🔧 Instalação e Inicialização do Projeto (Laravel 9)


Na pasta raiz da aplicação rode no terminal:

`composer install`
 
O nome do banco de dados que estabelecemos no arquivo .env é o "teste_solluti_api". Então será necessário que você configure esse banco no arquivo .env e crie esse banco na sua máquina (no Laravel 9, essa criação manual do banco de dados não é mais necessária). 
 
Rode o comando abaixo (No terminal, na pasta raiz do projeto), para criação das tabelas no banco:
 
`php artisan migrate`

Para teste do envio de email, recomendo o uso do Mailtrap. Pois foi o que foi usado no desenvolvimento. Você deve ir no site `https://mailtrap.io/` e fazer o cadastro.

Após o cadastro no Mailtrap, você deve ir em "Inboxes" -> "SMTP Settings" -> "Integrations" e selecionar a opção Laravel.
Com isso, será gerado seu código de configuração do serviço SMTP. Conforme o exemplo abaixo:

![Screenshot from 2022-11-08 13-37-58](https://user-images.githubusercontent.com/44420212/200623270-23adfd08-3eb0-4f94-b7e1-c59c52ae0fa0.png)

Então é só copiar esse código e substituir no arquivo .env do projeto.

 
Por fim, rodamos o comando abaixo, que roda nossa aplicação backend laravel (No terminal, na pasta raiz do projeto):
 
`php artisan serve`



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
