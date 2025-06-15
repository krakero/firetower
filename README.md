# Fire Tower

> This package is designed to be used in conjunction with a Fire Tower subscription. Find out more information at [https://firetower.dev](https://firetower.dev).

This package helps monitor your Laravel application by performing checks and sending information to the Fire Tower service.

## Installation

The first step, if you haven't done it already, is to sign up for an account at [https://firetower.dev](https://firetower.dev).

After signing up for an account, install the Fire Tower package into your project using the Composer package manager:

`composer require krakero/firetower`

Once complete run the following command to install the config file and service provider:

`php artisan firetower:install`

In the Fire Tower interface, create an application and paste the provided variables into your.env file:

```env
FIRETOWER_ACCOUNT_KEY=abcdefgh-hijk-1234-5678-90123lmnopqr
FIRETOWER_APPLICATION_KEY=zyxwvuts-rqpo-0987-6543-21098nmlkjih
```

Next, test everything by running `php artisan firetower:report` and refresh your application page.

## Documentation

You can find full documentation at [https://firetower.dev/docs](https://firetower.dev/docs).
