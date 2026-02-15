#  Dentist Site - Premium Dental Clinic Website

A modern, responsive, and premium website for a dental clinic, built with **Laravel** and **Tailwind CSS**.

![Dentist Site Hero](public/images/hero_screenshot.jpg) <!-- You can replace this with a real screenshot if available -->

##  Features

- **Premium UI/UX**: clean, modern design with a unified blue/sky color palette and glassmorphism effects.
- **Responsive Design**: Fully optimized for Desktop, Tablet, and Mobile devices.
- **Multilingual Support**: Supports Arabic (RTL), English, and French.
- **Dynamic Content**:
    - **Services**: Animated cards with hover effects.
    - **Gallery**: Image showcase.
    - **Testimonials**: Customer reviews slider.
    - **Booking**: Interactive appointment form.
    - **AI Assistant**: Floating chatbot for instant user support.
- **Dark Mode**: Fully functional premium dark mode with deep slate tones and toggle switch.
- **Performance**: Optimized assets using Vite.

##  Tech Stack

- **Framework**: [Laravel 10/11](https://laravel.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Icons**: [Font Awesome](https://fontawesome.com)
- **Build Tool**: [Vite](https://vitejs.dev)
- **Database**: SQLite (No external DB server required for demo)

##  Installation & Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/yourusername/dentist-site.git
    cd dentist-site
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Setup:**
    ```bash
    touch database/database.sqlite
    php artisan migrate --seed
    ```

5.  **Build Assets:**
    ```bash
    npm run build
    ```

6.  **Run the Server:**
    ```bash
    php artisan serve
    ```
    Visit `http://127.0.0.1:8000` in your browser.

##  Project Structure

- `resources/views`: Blade templates (Frontend).
- `public/css/premium.css`: Custom premium styles and animations.
- `public/js/scripts.js`: Interactive logic (Dark mode, Language switcher, Chatbot).
- `routes/web.php`: Application routes.

##  Customization

- **Colors**: The primary theme uses Tailwind's `sky` and `blue` palettes.
- **Dark Mode**: Configured in `tailwind.config.js` and `premium.css`.

##  License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
