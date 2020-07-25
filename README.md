# Simple Event App

`PHP 7.3.x`, `Laravel 7.x` `Vue 2.6.x` `Bootstrap 4.5.x`

## Setup Guide

### Installation

Clone and install dependencies:

```bash
$ git clone git@github.com:exmachina00/simple-calendar-events.git .
$ composer install
$ npm install
$ npm run dev (or npm run production)
```

### Configuration

Copy `.env.example` to `.env` and generate key.

```bash
$ cp .env.example .env
$ php artisan key:generate
```

Update configurations (Database config) in `.env`. After updating `.env`, run:

```bash
$ php artisan config:cache
$ php artisan migrate
```

