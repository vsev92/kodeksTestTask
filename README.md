## Tree viewer
test programming task

[![Tests](https://github.com/vsev92/kodeksTestTask/actions/workflows/tests.yml/badge.svg)](https://github.com/vsev92/kodeksTestTask/actions/workflows/tests.yml)


## Link to production:
https://kodeksTestTask-10vm.onrender.com/

## Prerequisites
* Linux
* PHP >=8.3
* Composer
* Make
* PostgeSQL

## Setup project
```bash
git clone git@github.com:vsev92/kodeksTestTask.git
cd  kodeksTestTask
make install
```
## Setup database
1. create empty PostgreSql database
2. Copy .env file from .env.example
## 
```bash
cp .env.example .env
```
3. Customize enviroment variables:
   * DB_CONNECTION
   * DB_HOST
   * DB_PORT
   * DB_DATABASE
   * DB_USERNAME
   * DB_PASSWORD
  to connect to created database

## Run frontend
```bash
npm run dev
```
## Run web server
```bash
make start
```
then web service is avaible localy on 127.0.0.1:8000