import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            backgroundImage: {
                'logo': "url('/images/logo.png')",
            },

            colors: {
                primary: '#E63946', // rouge personnalisé
                dark: '#1A1A1A',
            },
        },
    },

    plugins: [forms],
};
