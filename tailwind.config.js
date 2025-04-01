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
        'custom-font': ['"Your Custom Font"', 'sans-serif'], // 你的自定义字体
      },
      colors: {
      },
      spacing: {
        'screen-80': 'calc(100vh - 80px)',
        'screen-160': 'calc(100vh - 160px)',
        'screen-288': 'calc(100vh - 288px)',
      },
      aspectRatio: {
        '548/386':'548/386',
      },
      fontSize: {

      },
    },
  },
  plugins: [],
}

