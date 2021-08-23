const colors = require('tailwindcss/colors.js')

module.exports = {
  purge: [
    './resources/js/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        sans: ['Lato', 'sans-serif']
      }
    },
    
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
