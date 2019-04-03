# PHP Cint API

This is a PHP library to work with [Cint AB](https://www.cint.com)
 public APIs:

* [Connect API](https://cint-connect-api.readme.io/)
* [Demand API](https://cint-demand-api.readme.io/)
* [Profiling Data API](https://cint-profiling-data-api.readme.io/)
* [Panel API (CDP)](https://cint-panel-api-cdp.readme.io/)

## Requirements

* PHP 7.0+
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
```

Make sure you have set those environment variables. 

## Usage

TBD
