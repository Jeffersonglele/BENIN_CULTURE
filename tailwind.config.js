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
            keyframes: {
                fadeLeft: {
                    '0%': { opacity: 0, transform: 'translateX(-30px)' },
                    '100%': { opacity: 1, transform: 'translateX(0)' },
                },
            },
            animation: {
                fadeLeft: 'fadeLeft 1s ease-out forwards',
            },
        },
    },

    plugins: [forms],
};
