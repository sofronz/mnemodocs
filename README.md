# 📄 Mnemodocs

**Mnemodocs** is a personal project built to explore the integration of Vue.js with Inertia in a Laravel application. This project is designed around a simple document management use case and includes features focused on learning and experimentation with:

- Laravel queue and job processing
- Exporting data to Excel
- Frontend management using Vue.js
- Integration with Laravel Audit for activity logging

## 🚀 Features

- **Document & Category Management**: Upload, manage, and organize documents into categories.
- **User & Role Management**: Manage users and assign roles with specific access permissions.
- **Export to Excel**: Export data from various modules into Excel format.
- **Filtering**: Apply filters in each module for easier data navigation.
- **Activity Logging**: Track user actions and changes in each module for better auditing.

## 🛠️ Technologies Used

- **Backend**: Laravel 12
- **Frontend**: Vue.js 3 with Inertia.js
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **Excel Export**: Laravel Excel (maatwebsite/excel)
- **UI Framework**: Tailwind CSS
- **UI Theme**: [Admin One Vue Tailwind](https://github.com/justboil/admin-one-vue-tailwind)

### 🔧 Helpful Libraries

- **[maatwebsite/excel](https://github.com/Maatwebsite/Laravel-Excel)** – For exporting data to Excel files.
- **[owen-it/laravel-auditing](https://github.com/owen-it/laravel-auditing)** – To track model changes and user activity.
- **[kalnoy/nestedset](https://github.com/lazychaser/laravel-nestedset)** – For handling hierarchical data structures.
- **[barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)** – For generating IDE helper files and better code completion.
- **[friendsofphp/php-cs-fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)** – For automatic PHP code formatting and consistency.

## 📦 Installation

1. **Clone repositori:**

   ```bash
   git clone https://github.com/sofronz/mnemodocs.git
   cd mnemodocs
   ```

2. **Install backend dependencies:**

   ```bash
   composer install
   ```

3. **Install frontend dependencies:**

   ```bash
   npm install
   ```

4. **Copy the .env file and configure:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run database migrations and seed:**

   ```bash
   php artisan migrate --seed
   ```

6. **Start the development server:**

   ```bash
   php artisan serve
   npm run dev
   ```

## 🔐 Demo Accounts

- **Admin**
  - Email: The admin email is randomly generated from the database.
  - Password: `password`

- **User**
  - Email: The user email is randomly generated from the database.
  - Password: `password`

> Note: Both **Admin** and **User** accounts have dynamically generated email addresses from the database, so the email addresses may vary on different installations or setups. The default password for both Admin and User accounts is `password`.

## 📃 License

This project is licensed under the [MIT License](LICENSE).

## 📫 Contact

For questions or suggestions, feel free to contact [sofronz](https://github.com/sofronz).
