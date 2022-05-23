const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {},
    colors: {
        background: {
            light: colors.slate['50'],
            DEFAULT: colors.slate['50'],
            dark: colors['800'],
        },
        primary: "--color-primary",
        secondary: "--color-secondary",
        danger: "--color-danger",
        success: "--color-sucess",
        info: "--color-info",
        alert: "--color-alert"
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    }
  },
  plugins: [],
}