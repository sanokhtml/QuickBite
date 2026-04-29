import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js", // <-- ДОДАТИ ЦЕ
    ],

// ... решта коду
theme: {
    extend: {
        colors: {
            brand: '#1c64f2', // Це синій колір Flowbite
            neutral: {
                secondary: {
                    soft: '#f3f4f6' // Світло-сірий для ховера
                }
            }
        },
        fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
    },
},
// ... решта коду

    plugins: [
        forms,
        require('flowbite/plugin'), // <-- ДОДАТИ ЦЕ
    ],
};