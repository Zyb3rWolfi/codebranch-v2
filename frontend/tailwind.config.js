/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "node_modules/flowbite/**/*.js", // include Flowbite JS for purge
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1d4ed8', // example custom color
        secondary: '#9333ea',
        default: '#3C3C3C',
      },
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
    },
  },
  plugins: [
    require('flowbite/plugin'), // enables Flowbite components
  ],
}
