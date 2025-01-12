# webnoithat version 2

## Introduction

This project uses [Laravel](https://laravel.com/) for the backend (version:10x),  [Mysql] for save database. It is a web application designed to user can sign in(user, google) and can view and sell product.User can add product to cart and payment with vnpay and Payos.Version 2.0 introduces a complete refactor of the codebase, adopting dependency injection and object-oriented programming (OOP) principles.

## Libraries and Tools
### Frontend Libraries

- Build code with: Html, css, javascript.
- **[Libary]**: Morris Chart, Mmenu js, Boostrap, Magiczoom, Animate.css, Slick slider, Holdon,.. .

### Backend Libraries

- **[Laravel](https://laravel.com/)**: The PHP framework for building web applications.
- **[Eloquent ORM](https://laravel.com/docs/eloquent)**: Laravel's ORM for database interaction.
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)**: Simple token authentication for APIs.
- **[Laravel ShoppingCart](https://packagist.org/packages/hardevine/shoppingcart)**: Build Cart.
- **[Laravel laravel-dompdf](https://packagist.org/packages/barryvdh/laravel-dompdf)**: Change file html -> pdf.
- **[Laravel Queue](https://laravel.com/docs/11.x/queues#main-content)** mail sending to process emails asynchronously.
- **[Database transactions](https://laravel.com/docs/11.x/database#database-transactions)** :  to handle purchase and payment processes in a secure and atomic manner.
- **[Jquery]** : ajax.

### Database (Mysql)

### Development Tools

- **[Socialite](https://github.com/spatie/laravel-analytics)**: Get data user by google-analytics .

## Setting Up the Development Environment

### Setting Up Laravel

1. **Clone the repository**:

    ```bash
    git clone https://github.com/NguyenVanPhuoc1/webnoithat.git
    ```

2. **Install dependencies**:

    ```bash
    composer install 
    ```

3. **Create a `.env` file from the sample**:

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

5. **Run migrations (if needed)**:

    ```bash
    php artisan migrate
    ```

6. **Start the development server**:

    ```bash
    php artisan serve
    ```

## Usage

- **Running the Application**: After setting up, you can access the application at [http://127.0.0.1:8000](http://127.0.0.1:8000) for localhost.

- **Adding New Features**: Instructions on how to add new features or update the application.

- **Contributing**: Guidelines for contributing to the project.

## Documentation

- [Laravel Documentation](https://laravel.com/docs)

## Contact

For any questions, please reach out to [nguyenvanphuoc031123@gmail.com](mailto:nguyenvanphuoc031123@gmail.com).

