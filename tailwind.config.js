import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    darkMode: false,

    theme: {
        extend: {
            fontFamily: {
                sans: ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    50: "#e6e6ff",
                    100: "#b3b3ff",
                    200: "#8080ff",
                    300: "#4d4dff",
                    400: "#1a1aff",
                    500: "#0000cc",
                    600: "#000099",
                    700: "#000080", // warna utama
                    800: "#000066",
                    900: "#00004d",
                },
            },
        },
    },

    plugins: [forms],
};
