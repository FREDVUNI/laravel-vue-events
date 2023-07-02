# Event Management

This is a full-stack web application for Event Management. It provides a backend API built with Laravel and two frontend applications: a landing page and a dashboard. The landing page showcases events, while the dashboard allows for event management and attendee registration.

## Requirements

- PHP >= 7.4
- Composer
- Laravel >= 8.0
- MySQL or another supported database
- Node.js
- npm or Yarn

## Installation

1. Clone the repository:

```shell
git clone https://github.com/FREDVUNI/laravel-vue-events
```

2. Install backend dependencies:

```shell
cd event-management
composer install
```

3. Set up the environment:

```shell
cp .env.example .env
```

Edit the `.env` file and provide the necessary configuration for your database connection.

4. Generate the application key:

```shell
php artisan key:generate
```

5. Run the database migrations:

```shell
php artisan migrate
```

6. Install frontend dependencies for the landing page:

```shell
cd landing
npm install
```

7. Install frontend dependencies for the dashboard:

```shell
cd dashboard
npm install
```

## Usage

### Start the Development Server

To start the Laravel development server and serve the backend API and frontend applications together, run the following command:

```shell
php artisan serve
```

The application will now be accessible at `http://localhost:8000`.

### Landing Page

The landing page is built with Vue.js and Tailwind CSS. It showcases events and provides information to users. To compile the frontend assets and run the landing page, use the following command:

```shell
cd landing
npm run dev
```

The landing page will be accessible at `http://localhost:8000`.

### Dashboard

The dashboard is also built with Vue.js and Tailwind CSS. It allows for event management and attendee registration using the Laravel API.

To compile the frontend assets and run the dashboard, use the following command:

```shell
cd dashboard
npm run dev
```

The dashboard will be accessible at `http://localhost:8000/dashboard`.

## API Endpoints

The backend API provides various endpoints for managing events, attendees, registrations, and other related functionalities. Refer to the API documentation for detailed information on the available endpoints and request/response formats.

## Authentication and Authorization

You can implement authentication and authorization in the Laravel API using Laravel's built-in features or popular packages like Laravel Passport or Sanctum. Secure your API endpoints and dashboard routes as needed to ensure proper access control.

## Testing

You can run the automated tests for the Laravel API using the following command:

```shell
php artisan test
```

For the frontend applications, you can run tests using the following commands:

- Landing Page: `cd landing && npm run test`
- Dashboard: `cd dashboard && npm run test`

The tests ensure that the API endpoints, frontend components, and their functionalities are working correctly.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvement, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE)