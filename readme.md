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

Identified Vulnerabilities and Code Quality Issues
Below are the issues found in the source code that should be addressed to improve security, maintainability, and overall code quality:

1. Unused Constants and Variables
Remove any constants or variables that are declared but not used in the code.

Example: MASTER_TOKEN and $stored variables are declared but never used.

2. Trailing Whitespace
Remove unnecessary whitespace at the end of lines to keep the code clean and avoid version control conflicts.

3. Include Statements
Replace include with include_once to prevent multiple inclusions of the same file.

Use PHP's namespace import mechanism (use) instead of raw include where applicable.

4. Empty Methods
Add comments or exceptions to explain why a method is empty, or implement the required functionality to avoid confusion for other developers.
