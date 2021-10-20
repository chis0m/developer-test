<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>


## Requirements
> 1. You must have the docker registry installed on host machine
> 2. However you can run on your local machine if you are using php7.4 and above

## Setup

### Installation

> *Note:* For a quicker installation, you can copy and paste the below commands in your web directory
> and you are up and running in few minutes.

```bash
 git clone https://github.com/chis0m/developer-test.git && cd developer-test && ./setup.sh
```

#### Alternatively, step by step

```bash
  git clone https://github.com/chis0m/developer-test.git
  
  cp .env.example .env

  cd note-taker

  ./sail down --rmi all -v || true #Optional - This will remove images that may interfere with the installation
  
  ./sail build

  ./sail up -d
  
  ./sail composer install
  
  ./sail artisan key:generate
  
  ./sail artisan migrate --seed
 
```


> *Note:* if you want to stop the service just run:
> - **./sail down**


### Test
```bash
  ./sail test
```


### Analyses

```bash
    ./sail shell
    
    phpcbf
    
    phpcs
    
    phpstan
```

> **Note:**
> phpcbf | phpcs | phpstan are shortcuts for
> - *./vendor/bin/phpcbf* 
> - *./vendor/bin/phpcs* and
> - *./vendor/bin/phpstan analyse --memory-limit=2G*
> - It has already been aliased in the container's Dockerfile

### Application
> Access the application in your local host with
```bash
  http://127.0.0.1:9000 #Or any port you used in during deployment

```


## Author

Ejim Chisom - ejimchisom@gmail.com
PLease do reachout for any clearification. Thank you. Cheers!😉
