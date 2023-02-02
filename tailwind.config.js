const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('daisyui')],

    daisyui: {
        themes: [
            {
                emerald: {
                    "primary": "#007bff",
                    "secondary": "#7B92B2",
                    "accent": "#67CBA0",
                    "neutral": "#181A2A",
                    "base-100": "#FFFFFF",
                    "info": "#3ABFF8",
                    "success": "#28a745",
                    "warning": "#FBBD23",
                    "error": "#dc3545",
                }
            }
        ],
    },
};
