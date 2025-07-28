## Laravel Roles Permissions Admin - Spatie version

## Usage

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- That's it: launch the main URL and login with default credentials `admin@admin.com` - `password` for administrator
- That's it: launch the main URL and login with user credentials `user@user.com` - `12345678` for user

This boilerplate has two roles (`administrator`, `user`), two permission (`users_manage`, `user`) and one administrator user and one user.

With that administrator you can create more roles/permissions/users.

