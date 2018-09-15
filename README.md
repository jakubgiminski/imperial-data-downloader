# Imperial Data Downloader 

### Project Objectives
Create a service that downloads information about the whereabouts of princess Leia's prison cell.
Service should fetch data from an imaginary Excellence Http API. Additionally, downloaded information should be 
translated from binary to english.

### Excellence API Documentation
#### Authenticate User 
```js
{
    url = "/authenticate",
    method = "POST",
    headers = [ 
        "Content-Type: application/x-www-form-urlencoded"
    ],
    accepts = {
        "username": "solo",
        "password": "chewy"
    },
    returns = {
        "access_token": "e31a726c4b90462ccb7619e1b51f3d0068bf8006"
    }
}
```

#### Get Prisoner information
```js
{
    url = "/prisoners/leia",
    method = "GET",
    headers = [ 
        "Access-Token: e31a726c4b90462ccb7619e1b51f3d0068bf8006"
    ],
    returns = {
        "cell": "01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111",
        "block": "01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100"
    }
}
```

### Install project
```
composer install
```

### Execute tests
```
vendor/bin/phpunit tests --colors --testdox
```

### Api Documentation
```php
DownloadImperialData::__invoke(): array
```
