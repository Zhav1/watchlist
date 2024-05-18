import daisyui from 'daisyui'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './storage/framework/views/*.php',
    "./resources//*.blade.php",
    "./resources//*.js",
    "./resources//*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins:
  [
    require('daisyui')
  ],

//apabila warna background tampilan web menjadi hitam, tambahkan kode berikut
daisyui: {
  themes: ["light"]
}
}


