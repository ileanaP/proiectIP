<strong>Service Provider</strong>
<p>Pentru a lua categoriile din baza de date:
<li> am creat migratia "categories"</li>
<li> am creat modelul Category (App\Category.php)</li>
<li> am creat un nou Service Provider (App\Providers\ViewComposerServiceProvider:
aici vom pune toate comenzile $view->composer() de care vom avea nevoie pentru a trimite date
din baza de date catre view-uri)</li>
<li> am importat modelul Category in noul SP</li>
<li> am creat o functie composeSidebar() pe care o apelez in functia boot a provider-ului
(cea care se apeleaza atunci cand se afiseaza un view),
in care am apelat metoda composer() a variabilei $view corespunzatoare acestei pagini (layouts.sidebar)</li>
<li> am inregistrat noul SP in config\app.php</li></p>

<strong>Migrations</strong>
<p> Pentru a referntia o cheie externa din tabelul Y in tabelul X, time-stamp-ul de creare
al tabelului Y trebuie sa fie mai mic decat cel al tabelului X
(deci prima data sa creezi tabelul Y, apoi tabelul X xD). Pentru a modifica
timestamp-ul:
<li>mergi in folderul "migrations" din database\migrations in
folder explorer</li>
<li>modifici timestamp-urile manual (timestamp-urile sunt de forma
2017_03_29_192037, unde 2017_03_29_000000 reprezinta prima secunda
din ziua 29 martie, 2017</li></p>

<strong>Sidebar</strong>
<p>Sidebar-ul din events list este in resources\layouts, dar ar trebui
sa fie in resources\includes</p>

<strong>"use.."</strong>
<p>Pentru a include modele/controllere sau pentru a accesa directoare
in git bash (sau prin php artisan) se foloseste "<strong>\</strong>",
daca folosesti "<strong>/</strong>" iti da eroare

<strong>Ce a cauzat bug #4</strong>
<p>Nu poti folosi functia in_array pe un set de date luat din baza
de date cu ajutorul unui model, pentru ca e un obiect, nu un array. De
asemenea, nu poti folosi ->isEmpty() pe un array, pentru ca este o
functie destinata obiectelor. Dar aveam nevoie de un obiect pentru a
afisa numele user-ilor si pentru a accesa pagina de utilizator a acestora
din lista de participanti. Solutia a fost deci sa transmit array-ul
usrid din EventsController@eventPage view-ului pages.eventPage, sa folosesc 
pentru in_array array-ul $usrid, si pentru ->isEmpty() obiectul 
$attendees</p>
<p>SAU am uitat sa adaug ->get() cand am luat user-ul din baza
de date cu ajutorul functiei User::find(...) (de studiat)</p>

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](http://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Styde](https://styde.net)**
- **[Codecourse](https://www.codecourse.com)**
- [Fragrantica](https://www.fragrantica.com)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
