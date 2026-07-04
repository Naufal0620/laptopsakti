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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#fff8f2',
                    100: '#ffeedc',
                    200: '#ffd3ad',
                    300: '#ffb178',
                    400: '#ff8539',
                    500: '#f15a24', // Premium Brand Orange
                    600: '#d9410e',
                    700: '#b23005',
                    800: '#8c2100',
                    900: '#661600',
                    950: '#3d0900',
                },
            },
            borderRadius: {
                'xl': '0.5rem',     // 8px
                '2xl': '0.75rem',   // 12px
                '3xl': '1rem',      // 16px
            }
        },
    },

    plugins: [forms],
};
