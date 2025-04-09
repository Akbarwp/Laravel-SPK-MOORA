import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                plusJakartaSans: ['Plus Jakarta Sans'],
                spaceGrotesk: ['Space Grotesk'],
            },
            colors: {
                'background-cover': '#BB7334',
                'background-cover-dark': '#944535',

                'background': '#FFFFFF',
                'background-dark': '#FAD6A6',

                'primary-color': '#BB7334',
                'secondary-color': '#DAD8D2',
                'primary-color-dark': '#944535',
                'secondary-color-dark': '#FAD6A6',
            },
        },
    },

    plugins: [
        forms,
        require('daisyui'),
    ],
};
