/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'soft-white': "#F9FBFD",
                'primary': {
                    100: "rgba(1, 111, 185, .1)",
                    200: "rgba(1, 111, 185, .2)",
                    300: "rgba(1, 111, 185, .3)",
                    400: "rgba(1, 111, 185, .4)",
                    500: "rgba(1, 111, 185, .5)",
                    600: "rgba(1, 111, 185, .6)",
                    700: "rgba(1, 111, 185, .7)",
                    800: "rgba(1, 111, 185, .8)",
                    900: "rgba(1, 111, 185, 1)"
                    // #016fb9
                },
                'light-blue': 'rgba(183, 211, 242)',
                'dark-blue': {
                    100: "rgba(1, 22, 39, .1)",
                    200: "rgba(1, 22, 39, .2)",
                    300: "rgba(1, 22, 39, .3)",
                    400: "rgba(1, 22, 39, .4)",
                    500: "rgba(1, 22, 39, .5)",
                    600: "rgba(1, 22, 39, .6)",
                    700: "rgba(1, 22, 39, .7)",
                    800: "rgba(1, 22, 39, .8)",
                    900: "rgba(1, 22, 39, 1)"
                },
                'light-brown': '#dea47e',
                'dark-brown': {
                    100: "rgba(158, 98, 64, .1)",
                    200: "rgba(158, 98, 64, .2)",
                    300: "rgba(158, 98, 64, .3)",
                    400: "rgba(158, 98, 64, .4)",
                    500: "rgba(158, 98, 64, .5)",
                    600: "rgba(158, 98, 64, .6)",
                    700: "rgba(158, 98, 64, .7)",
                    800: "rgba(158, 98, 64, .8)",
                    900: "rgba(158, 98, 64, 1)"
                },

            },
            fontFamily: {
                'big-title': "Neutra, sans-serif",
                'title': "Fira, sans-serif",
                'body': "Harriet, serif"
            },
            backgroundImage: {
                'home': "url('/public/frontend/assets/book-library.jpg')",
                'mobile-home': "url(/public/frontend/assets/mobile-bg-1.jpg)",
                'subscribe': "url(/public/frontend/assets/bg-4.jpg)"
            }
        },
    },
    plugins: [],
};
