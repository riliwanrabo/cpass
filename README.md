# Loan Repayment Test

A TalentQL/CredPal assessment using Laravel.

There are 2 parts 

- Loan Calculator API
- Currency Backend and Frontend

##### Require:
* PHP: ^8.0

## Features

* Basic Features: Loan Calculator
* Currency Backend and Frontend



#### Install Dependencies

```
$ composer install
$ npm install && npm run dev 
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```

#### FIXER API for rates add to .env
```
FIXER_BASE_URL=http://data.fixer.io/api
FIXER_API_KEY=806dbdf1a4250a4fa926376c9de4b694
```

```
$ php artisan migrate:fresh --seed
```
### API Routes For Calculator
```
POST {{base_url}}/api/calculator

payload
-------
{
    "amount": 100000.00,
    "interest": 5,
    "duration": "6",
    "repayment_day": 28
}
```

### WEB Routes Exchange
```
- Launch the web server using php artisan or any comfortable means
- Register a new user or login with admin@credpal.com and password as credentials
- Click on the Currencies menu and navigate
- The Threshold notification has been implemented and runs hourly
```

Regards.

