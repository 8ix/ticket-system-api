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

1. Download the repository and set it up in a directory. The original project directory was called:
   ```
   ticket-system-api
   ```

2. Ensure you have Docker installed on your system. If not, download and install it from [docker.com](https://www.docker.com/products/docker-desktop).

3. Create a project .env file from the .env.example using the following command:
   ```
   cp .env.example .env
   ```

4. Build and start the Docker containers:
   ```
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php82-composer:latest \
       composer install --ignore-platform-reqs
   ```

5. Start the Laravel Sail environment:
   ```
   ./vendor/bin/sail up -d
   ```

6. Generate application key:
   ```
   ./vendor/bin/sail artisan key:generate
   ```

7. Run database migrations:
   ```
   ./vendor/bin/sail artisan migrate
   ```

8. (Optional) If you have sample data or seeders, run:
   ```
   ./vendor/bin/sail artisan db:seed
   ```

Note: These instructions assume you're using a Unix-like operating system (Linux or macOS). If you're on Windows, you may need to adjust some commands or use Windows Subsystem for Linux (WSL).

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




