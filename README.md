# Laravel SPK MOORA

Laravel SPK MOORA is a website designed to provide a decision support system using the MOORA (Multi Objective Optimizaton By Ratio Analysis) method. This site enables users to analyze various decision alternatives based on defined criteria, assisting in determining the best choice in a systematic and transparent way. With a user-friendly interface, users can easily input data and obtain in-depth analysis results to support more accurate decision-making.

## Tech Stack

- **Laravel 12**
- **Laravel Breeze**
- **MySQL Database**
- **TailwindCSS**
- **daisyUI**
- **[maatwebsite/excel](https://laravel-excel.com/)**
- **[barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)**

## Features

- Main features available in this application:
  - Implementation MOORA method
  - Import data --> example [Kriteria](https://github.com/user-attachments/files/19659205/Import.Kriteria.xlsx), [Sub kriteria](https://github.com/user-attachments/files/19659207/Import.Sub.Kriteria.xlsx), [Alternatif](https://github.com/user-attachments/files/19659204/Import.Alternatif.xlsx), [Penilaian](https://github.com/user-attachments/files/19659206/Import.Penilaian.xlsx)

## Installation

Follow the steps below to clone and run the project in your local environment:

1. Clone repository:

    ```bash
    git clone https://github.com/Akbarwp/Laravel-SPK-MOORA.git
    ```

2. Install dependencies use Composer and NPM:

    ```bash
    composer install
    npm install
    ```

3. Copy file `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Setup database in the `.env` file:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_moora
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. Run migration database:

    ```bash
    php artisan migrate
    ```

7. Run seeder database:

    ```bash
    php artisan db:seed
    ```

8. Run website:

    ```bash
    npm run dev
    php artisan serve
    ```

## Screenshot

- ### **Dashboard**

<img src="https://github.com/user-attachments/assets/5f81514c-7d6b-4b9c-948d-2e5a69f2a064" alt="Halaman Dashboard" width="" />
<br><br>

- ### **Criteria page**

<img src="https://github.com/user-attachments/assets/96852d31-eb15-4cf2-b5b2-a4ba91af7d77" alt="Halaman Kriteria" width="" />
<br><br>

- ### **Penilaian page**

<img src="https://github.com/user-attachments/assets/7f35f029-efb4-4429-9f99-d9a2edf7aae1" alt="Halaman Penilaian" width="" />
<br><br>

- ### **Result page**

<img src="https://github.com/user-attachments/assets/18d0f7f1-5851-4687-823e-7f2b26289cfc" alt="Halaman Hasil Akhir" width="" />
<br><br>
