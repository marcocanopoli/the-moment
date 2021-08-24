const colors = require('tailwindcss/colors.js')

module.exports = {
  purge: {
    // enabled: true,
    content:[
      './resources/js/App.vue',
      './resources/js/components/*.vue',
      './resources/js/views/*.vue'
    ],
    // safelist: [
    //   'text-red-500',
    //   'text-indigo-500',
    //   'text-gray-600'
    // ]
  },
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
