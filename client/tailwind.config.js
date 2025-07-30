/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './index.html',
    './src/**/*.{vue,js,ts,jsx,tsx}',
    './components/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#a6e61f',
        secondary: '#59bc1c',
        dark: '#3d942f',
      },
    },
  },
  plugins: [],
}
