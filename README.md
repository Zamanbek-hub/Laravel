# HeadHunter
## Hi this project done for Univer IITU, Laravel 8 course

Project Include
- User roles
- Create Resumes, Vacancy
- Collect Favorite Resumes and Vacancies
- Download PDF variant
- Admin Panel
- CRUD for all Model in Admin Panel
- Statistic in Admin Panel
- AJAX requests

User Roles:
- [x] Admin
- [x] Employer
- [x] Student

# Short Review you can see on Report.docx

## Additional Libraries

- DomPDF (installation)

Run the under-mentioned command to install DomPDF in Laravel 7/8
```
composer require barryvdh/laravel-dompdf
```

Open config/app.php file and incorporate DomPDF service provider in providers array along with DomPDF facade to the aliases array.

```
'providers' => [
  Barryvdh\DomPDF\ServiceProvider::class,
],

'aliases' => [
  'PDF' => Barryvdh\DomPDF\Facade::class,
]
```

Execute the following command to publish the assets from vendor.
```
php artisan vendor:publish
```