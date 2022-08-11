<div align="center">
<img src="https://i.imgur.com/9ePNdJ4.png" alt="Atom HK"/>
</div>

## What is Atom HK?
Atom HK is a standalone Habbo retro housekeeping, aiming to provide an easy and solid experience for you to manage various aspects of your hotel. It offers an easy development experience thanks to the use of Laravel & Bootstrap.

*Standalone means it is its own project, rather than being coded directly into the CMS, it will rather be on a sub-domain, connected to the same database as your CMS. This allows you to easily use the housekeeping with little to no adjustments no matter the CMS you use*

**What technologies is being used?**
- Laravel 9.x (Latest as of August 2022)
  [Laravel docs](https://laravel.com/docs/9.x).
- Vite [Vite docs](https://vitejs.dev/).
- Bootstrap
  [Bootstrap docs](https://getbootstrap.com/docs/4.0/getting-started/introduction/).

If you are new to Laravel, then theres luckily tons of resources online to help you learn it. One of the best options is those two video courses. 
- https://laracasts.com/series/laravel-8-from-scratch
- https://laracasts.com/series/whats-new-in-laravel-9

## Why was Atom HK made?
Atom HK was made to bring the retro community a solid base to build a housekeeping from. As previously mentioned Atom HK is a standalone housekeeping, allowing you to use it on any CMS with little to no edits.

Laravel was chosen as its backend, due to it being robust and battle tested "in the real world" on top up that it has a huge community to back it, with tons of free (& paid) learning resources and its solid documentation that other projects' normally lack. Combine those things together and you'll be able to build anything you want even as a beginner, you dont need to be a PHP expert or a frontend master to work with Atom HK!

## Setup guide
To install Atom HK you'll need to do the following:
- PHP 8.1 or above [PHP Downloads](https://www.php.net/downloads.php)
- Composer v2 [Composer Download](https://getcomposer.org/download/)
- NPM (LTS) [Node Download](https://nodejs.org/en/download/)
- An Arcturus Morningstar database [Database repository](https://git.krews.org/morningstar/arcturus-morningstar-base-database)

After all of the above has been installed you've to do the following:
- Open CMD and navigate into the path you want the housekeeping to be located at, and run the commands listed below

#### Windows
```
[Https] git clone https://github.com/ObjectRetros/atomhk.git
[SSH - Recommended] git clone git@github.com:ObjectRetros/atomhk.git
cd atomhk
copy .env.example .env
composer install 
npm install && npm run dev (for production you run: npm run build)
php artisan key:generate
php artisan migrate --seed
```

For IIS - You must link your site to the public folder of the housekeeping

#### Linux
```
[Https] git clone https://github.com/ObjectRetros/atomhk.git
[SSH - Recommended] git clone git@github.com:ObjectRetros/atomhk.git
cd atomhk
cp .env.example .env
composer install
npm install && npm run dev (for production you run: npm run build)
php artisan key:generate
php artisan migrate --seed
```

For NGINX you can copy the config from here: [Deploy a site on nginx](https://laravel.com/docs/9.x/deployment#nginx)

