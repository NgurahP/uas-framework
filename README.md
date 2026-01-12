<h1>Informasi instalasi untuk setiap kontributor :</h1>
<b>setelah clone repositori, tolong jalankan pertintah ini pada repo yang telah di clone:</b><br>
- composer install<br>
- cp .env.example .env <br>
- php artisan key:generate <br>
<b>setelah menjalankan perintah diatas, lakukan beberapa perubahan berikut:</b> <br>
- buat database dengan nama "lumpia" pada "localhost/phpmyadmin" <br>
- hapus tanda "#" / blok dan "ctrl+/" kode berikut yang ada di file .env "# DB_HOST=127.0.0.1 # DB_PORT=3306 # DB_DATABASE=lumpia # DB_USERNAME=root # DB_PASSWORD=" <br>
- dan jalankan php artisan migrate <br>
<b>setelah semua itu, jalankan "php artisan serve" dan buka localhost:8000 pada browser. seharusnya tidak ada error jika semua langkah sebelumnya telah berhasil</b> <br>

<h1>Informasi push kode baru ke github:</h1>
<b>pada repo ini akan ada 3 branch yaitu</b><br>
- main : sebagai branch utama <b>jangan pernah push ke branch ini secara langsung dengan alasan apapun</b> <br>
- front : akan digunakan oleh yang ngurus tampilan/UI. <b>jika sedang mengerjakan tampilan web tolong push ke sini</b> <br>
- back : akan digunakan oleh yang ngurus yang berhubungan dengan database <b>jika sedang mengerjakan database tolong push ke sini</b> <br>
<b>setelah push perubahan pada brach masing masing, tolong buat pull request. dengan langkah langkah seperti berikut :</b> <br>
- setelah buka repositori pada web github.com, klik "pull request" pada navbar nya <br>
- setelah masuk ke menu pull request, klik "new pull request" yang ada pada kanan atas dengan background hijau <br>
- setelah ada pada "new pull request", pilih branch yang kalian ingin gabungkan pada bagian "compare", dan klik pull request <br>
- lalu pilih semua orang yang ada untuk aprrove perubahan. <b>jangan langsung aprrove perubahan sendiri, karena dapat terjadi konflik yang tidak diinginkan</b> <br>

<h1>Informasi sebelum mulai koding<h1>
<b>- ingat selalu untuk merubah branch ke branch yang diinginkan</b>
<b>- selalu cek perubahan dengan menjalankan "git pull" agar kodingan yang telah dibuat tidak hilang karena tertimpa dengan kodingan yang ada di branch</b>

<h1>ingat selalu untuk lapor perubahan sekecil apapun ke grup, dan jelaskan perubahan apa yang telah dibuat</h1>



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
