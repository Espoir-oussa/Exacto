import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            backgroundImage: {
                'logo': "url('/images/Logo IMUXT.png')",
                'logo': "url('/images/Logo IMUXT (Blanc).png')",
            },

            colors: {
                primary: '#ffffff', // rouge personnalisé
                dark: '#164f63',
            },
        },
    },

    plugins: [forms],
};
