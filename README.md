# Ticket Management System

This project is a ticket management system built with Laravel, featuring automated ticket generation and processing.

## Tech Stack

- Laravel 11
- PHP 8.2
- MySQL 8.0
- Pest PHP Testing Framework

## Setup

This project uses Laravel Sail for easy setup and consistent development environments.

### Prerequisites

- Docker
- Docker Compose

### Installation

1. Download the repository and setup in a directory the original project directory was called
   ```
   ticket-system-api
   ```

2. Start the Laravel Sail environment:
   ```
   ./vendor/bin/sail up -d
   ```

3. Generate application key:
   ```
   ./vendor/bin/sail artisan key:generate
   ```

## Database Setup

1. Run migrations:
   ```
   ./vendor/bin/sail artisan migrate
   ```

2. Seed the database:
   ```
   ./vendor/bin/sail artisan db:seed
   ```

## Commands

This project includes two main commands:

1. Generate Ticket: Creates a new ticket (runs every minute)
   ```
   ./vendor/bin/sail artisan ticket:generate
   ```

2. Process Tickets: Processes up to 5 unprocessed tickets (runs every 5 minutes)
   ```
   ./vendor/bin/sail artisan tickets:process
   ```

To demo the scheduler, run:
```
./vendor/bin/sail artisan schedule:work
```


## Testing

This project aims for 80% test coverage using Pest. To run the tests and view coverage:

```
./vendor/bin/sail artisan test --coverage
```

For a detailed HTML coverage report:

```
./vendor/bin/sail artisan test --coverage-html reports/
```

## Frontend

This is the backend part of the API Ticket project, There is a Typescript frontend that accompanies this as a demo. 




