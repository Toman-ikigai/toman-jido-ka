/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.html", "./**/*.php", "./*.php"],
  theme: {
    extend: {
      colors: {
        primaryC: {
          yellow: "#ffff00",
          black: "#2C2C2C",
        },
        secondaryC: {
          gray: "#E0E0E0",
          orange: "#FFA500",
        },
        neutralC: {
          white: "#FFFFFF",
          brown: "#D2B48C",
        },
      },
    },
  },
  plugins: [],
};
