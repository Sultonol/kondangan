/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                inter: ["Inter", "sans-serif"],
                dancing: ["Dancing Script", "cursive"],
            },
            animation: {
                "spin-slow": "spin 8s linear infinite",
                float: "float 3s ease-in-out infinite",
                "pulse-glow": "pulse-glow 2s infinite",
            },
            keyframes: {
                float: {
                    "0%, 100%": { transform: "translateY(0px)" },
                    "50%": { transform: "translateY(-10px)" },
                },
                "pulse-glow": {
                    "0%": {
                        boxShadow: "0 0 0 0 rgba(34, 197, 94, 0.7)",
                        transform: "scale(1)",
                    },
                    "50%": {
                        boxShadow: "0 0 0 8px rgba(34, 197, 94, 0.2)",
                        transform: "scale(1.05)",
                    },
                    "100%": {
                        boxShadow: "0 0 0 0 rgba(34, 197, 94, 0)",
                        transform: "scale(1)",
                    },
                },
            },
        },
    },
    plugins: [],
};
