import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import plugin from "tailwindcss";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/wireui/breadcrumbs/src/Components/**/*.php",
        "./vendor/wireui/breadcrumbs/src/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            margin: {
                15: "3.75rem",
            },
            padding: {
                4.5: "1.125rem",
            },
            gap: {
                7.5: "1.875rem",
            },
            width: {
                "4/10": "40%",
                ...Object.fromEntries(
                    Array.from({ length: 100 }, (_, i) => [
                        `${i + 1}p`,
                        `${i + 1}%`,
                    ]),
                ),
            },
            fontFamily: {
                opensans: ["Open Sans", ...defaultTheme.fontFamily.sans],
                raleway: ["Raleway", ...defaultTheme.fontFamily.sans],
                fontAwesome: ["FontAwesome"],
            },
            colors: {
                primary: "#0b0a36",
                primaryDark: "#080725",
                secondary: "#418b78",
                secondaryDark: "#336f60",
                text: "#3b3b4f",
                "text-gray": "#8a8a9a",
                select: "#f2f6f7",
                "light-gray": "#dbdbe9",
                "dark-gray": "#f2f6f7",
                green: "#9cd161",
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
                welcomeSlide: "url('/public/images/slide1.png')",
                heroBg: "url('/public/images/hero-bg.jpg')",
                formBg: "url('/public/images/form-bg.png')",
                testimonialBg: "url('/public/images/testimonial-bg.png')",
                testimonialSwiperBg:
                    "url('/public/images/testimonial-swiper-bg.png')",
            },
            keyframes: {
                slide: {
                    "0%": { transform: "translateY(-100%)" },
                    "100%": { transform: "translateY(0%)" },
                },
            },
            animation: {
                slide: "slide 1s ease",
            },
        },
    },

    plugins: [
        forms,
        plugin(function ({ addUtilities, theme }) {
            const widthUtilities = Object.entries(theme("width")).reduce(
                (acc, [key, value]) => {
                    if (key.endsWith("p")) {
                        acc[`.w-${key}`] = { width: value };
                    }
                    return acc;
                },
                {},
            );

            addUtilities(widthUtilities);
        }),
    ],
};
