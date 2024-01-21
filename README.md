<p align="center"><img src="/art/socialcard.png" alt="Social Card of Fire Tower"></p>

# Fire Tower

> This package is designed to be used in conjuction with a Fire Tower subscription. Find out more information at [https://firetower.dev](https://firetower.dev).

This package helps monitor your Laravel application by performing checks and sending information to the Fire Tower service.

## Installation

The first step, if you haven't done it already, is to sign up for an account at [https://firetower.dev](https://firetower.dev).

After signing up for an account, install Fire Tower into your project using the Composer package manager:

`composer require krakero/firetower`

After installing Fire Tower, login to your account and create an application.

Once you create an application paste the provided variables into your.env file:

```env
FIRETOWER_ACCOUNT_KEY=abcdefgh-hijk-1234-5678-90123lmnopqr
FIRETOWER_APPLICATION_KEY=zyxwvuts-rqpo-0987-6543-21098nmlkjih
```

Next, test everything by running `php artisan firetower:report` and refresh your application page.

## Documentation

You'll find the documentation for this package online at [https://firetower.dev/docs](https://firetower.dev/docs).
