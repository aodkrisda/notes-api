# notes-api
REST API for Notes and Reminders
Built with Slim Framework, Monolog, Eloquent ORM, Respect Validation and PHP-JWT

#### Issues
- If you get an error with something like this `Call to undefined function mcrypt_create_iv()` you have to install `mcrypt` extension or if you have already done that you have to enable it. In my case, I'm running the project on a Ubuntu machine, so I did the following steps:
```
$ sudo apt-get install php5-mcrypt
$ sudo php5enmod mcrypt
$ sudo service apache2 restart
```

## Links
- [Slim Framework](https://github.com/slimphp/Slim)
- [slim3-skeleton](https://github.com/akrabat/slim3-skeleton)
- [slim3-eloquent](https://github.com/kladd/slim-eloquent)
- [Eloquent ORM](https://github.com/illuminate/database)
- [Monolog](https://github.com/Seldaek/monolog)
- [Respect Validation](https://github.com/Respect/Validation)
- [Run Slim 2 from the Command Line](https://akrabat.com/run-a-slim-2-application-from-the-command-line/)
- [password_hash](http://php.net/manual/en/function.password-hash.php)
- [PHP-JWT](https://github.com/firebase/php-jwt)
- [jwt.io](http://jwt.io/)
- [PHP Authorization with JWT (JSON Web Tokens)](http://www.sitepoint.com/php-authorization-jwt-json-web-tokens/)
- [JSON API](http://jsonapi.org/)
- [Cookies vs Tokens. Getting auth right with Angular.JS](https://auth0.com/blog/2014/01/07/angularjs-authentication-with-cookies-vs-token/)
- [Ask Auth0](https://ask.auth0.com/)
