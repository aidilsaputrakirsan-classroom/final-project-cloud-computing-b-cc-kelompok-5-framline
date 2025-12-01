/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
   safelist: [
        'dark',
        'light',
        'dark',
        'text-white',
        'bg-gray-900',
        'bg-white',
    ],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

