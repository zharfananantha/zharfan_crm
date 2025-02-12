# zharfan_crm

Simple CRM Web Application built with Laravel and PostgreSQL.

## Prerequisites

Before you begin, ensure you have the following installed:

- [PHP](https://www.php.net/downloads) (version 8.0 or higher)
- [Composer](https://getcomposer.org/download/)
- [Node.js and npm](https://nodejs.org/en/download/)
- [PostgreSQL](https://www.postgresql.org/download/)

## Installation Steps
1. **Clone the Repository**

   ```bash
   git clone https://github.com/zharfananantha/zharfan_crm.git
   cd zharfan_crm
   
2. Install PHP Dependencies

    Use Composer to install the necessary PHP packages:
    ```bash
    composer install

  
3. Install JavaScript Dependencies

    Use npm to install the required JavaScript packages:
    ```bash
    npm install

4. Configure Environment Variables
    
* Duplicate the .env.example file and rename the copy to .env:
    ```bash
    cp .env.example .env
    
* Open the .env file and set the following variables to match your PostgreSQL configuration:
    ````bash
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    
5. Generate Application Key

    ````bash
    php artisan key:generate

6. Run Database Migrations

    Set up the database tables by running:
    ````bash
    php artisan migrate

7. Compile Assets

    Build the front-end assets using Vite:
    ````bash
    npm run build

8. Start the Development Server

    Launch the application:
    ````bash
    php artisan serve
    
## Links 

For your convenience, I have prepared a database backup that you can restore to your database. You can download it from the following [link](https://drive.google.com/drive/folders/18MsXJ7u8x4FsD3FJDwhedQef1oigTkP4?usp=sharing)

I already deployed this demo crm, you can try and open it from the following [link](https://zharfancrm-production.up.railway.app/)
