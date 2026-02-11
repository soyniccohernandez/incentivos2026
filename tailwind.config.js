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
                // Unifica aquí todas tus fuentes
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                bebas: ['"Bebas Neue"', 'sans-serif'],
                montserrat: ['Montserrat', 'sans-serif'],
            },
            colors: {
                'brand-orange': '#E8521B',
                'brand-deep': '#000000',
                'brand-surface': '#0f0f0f',
                'brand-border': '#222222',
            },
        },
    },

    plugins: [forms],
};
