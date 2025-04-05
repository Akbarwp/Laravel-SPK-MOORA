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
                'reno-sand': '#BB7334',
                'timberwolf': '#DAD8D2',
                'el-salva': '#944535',
                'peach-yellow': '#FAD6A6',

                'affair': '#77547C',
                'pale-pink': '#F6D7E4',
                'zambezi': '#665551',
                'spanish-white': '#BDAC9C',
            },
        },
    },

    plugins: [
        forms,
    ],
};
