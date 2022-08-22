# Fire Tower

## Custom Data
You can add any data you would like to the reports that get sent. Just add your data to the `boot` method of your `AppServiceProvider` like this:

```php
    public function boot()
    {
        FireTower::setCustomData(function () {
            return [
                'my_custom_property' => MyCustomClass::myFunction(),
            ];
        });
        // ...
    }
```
