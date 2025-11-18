import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.css',
        './resources/**/*.vue',
        './resources/**/*/*/*.blade.php',
        "./vendor/filament/**/*.blade.php",
        './resources/views/filament/admin/widgets/*.blade.php',
         
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                navbar :'#5AA7C4',
                second : '#B3E0EE',
                tombol :'#FF6900',
                back :'#FFFFF0',
                primary: '#5AA7C4',
                        secondary: '#B3E0EE',
                        accent: '#FF6900',
                        ivory: '#FFFFF0'
                
            },
            screens: {
                'xs': '300px', // Untuk HP kecil
                '2xl': '1440px', // Untuk monitor besar
              },
        },
    },
    plugins: [
        require('taos/plugin')
    ],
    safelist: [
        '!duration-[0ms]',
        '!delay-[0ms]',
        'html.js :where([class*="taos:"]:not(.taos-init))'
      ],
};
