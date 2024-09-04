import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                opensans: ["Open Sans", ...defaultTheme.fontFamily.sans],
                raleway: ["Raleway", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#0b0a36",
                secondary: "#418b78",
                text: "#3b3b4f",
                select: "#f2f6f7",
            },
            backgroundImage: {
                selectCategory:
                    "url('/public/images/icon-cap.svg'), url('/public/images/icon-down.svg')",
                selectClass:
                    "url('/public/images/icon-book.svg'), url('/public/images/icon-down.svg')",
                selectLocation:
                    "url('/public/images/icon-marker.svg'), url('/public/images/icon-down.svg') ",
                selectTeacher:
                    "url('/public/images/icon-user.svg'), url('/public/images/icon-down.svg')",
            },
        },
    },

    plugins: [forms],
};
