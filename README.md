# PHP Cint API

This is a PHP library to work with [Cint AB](https://www.cint.com)
 public APIs:

* [Connect API](https://cint-connect-api.readme.io/)
* [Demand API (Buyer API)](https://cint-demand-api.readme.io/)
* [Panel API (cdp)](https://cint-panel-api-cdp.readme.io/)

## Requirements

* PHP 7.1+
* [Guzzle](http://guzzlephp.org)

## Installation

```bash 
composer require syno/cint
```

#### For Symfony projects

1. Register bundle in bundles.php
2. Add config file, e.g. config/packages/syno_cint.yaml with the following content:

```yaml
syno_cint:
  connect:
    account_id: '%env(CINT_CONNECT_API_DEFAULT_ACCOUNT)%'
    username: '%env(CINT_CONNECT_API_DEFAULT_USERNAME)%'
    password: '%env(CINT_CONNECT_API_DEFAULT_PASSWORD)%'

  demand:
    api_domain: '%env(CINT_DEMAND_API_DOMAIN)%'
    api_key: '%env(CINT_DEMAND_API_KEY)%'
```

Make sure you have set those environment variables. 

## Usage

TBD

