/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {

    extend: {
        colors: {
            // primary: {
            //     "50": "#f0fdfa",
            //     "100": "#ccfbf1",
            //     "200": "#99f6e4",
            //     "300": "#5eead4",
            //     "400": "#2dd4bf",
            //     "500": "#14b8a6",
            //     "600": "#0d9488",
            //     "700": "#0f766e",
            //     "800": "#115e59",
            //     "900": "#134e4a",
            //     "950": "#042f2e"
            // },
            'caribbean': '#205E61',
            'teal': '#3D8183',
            'amber': '#F2B705',
            'whiteSmoke': '#F5F5F5',
            'jet': '#333333',
            'abu': '#777777',
            'orange-peel': '#FF9800',
            'cerulean': '#006E90',
            'danger': '#D32F2F'
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
    },
  },
  plugins: [
    require('flowbite/plugin'),
  ],
}

