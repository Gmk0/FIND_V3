import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

function withOpacity(variableName) {
    return ({ opacityValue }) => {
        if (opacityValue !== undefined) {
            return `rgba(var(${variableName}), ${opacityValue})`
        }
        return `rgb(var(${variableName}))`
    }
}

import preset from './vendor/filament/support/tailwind.config.preset'
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');
const colors = require('tailwindcss/colors');

const navyColor = {
    50: "#E7E9EF",
    100: "#C2C9D6",
    200: "#A3ADC2",
    300: "#697A9B",
    400: "#5C6B8A",
    450: "#465675",
    500: "#384766",
    600: "#313E59",
    700: "#26334D",
    750: "#222E45",
    800: "#202B40",
    900: "#192132",
};


/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [preset, require('./vendor/wireui/wireui/tailwind.config.js')],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
       './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php',
        "./node_modules/flowbite/**/*.js"
    ],



    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
            },
            textColor: {
                skin: {
                    base: withOpacity('--color-text-base'),
                    muted: withOpacity('--color-text-muted'),
                    inverted: withOpacity('--color-text-inverted'),
                }
            },
            animation: {
                "spin-slow": "spin 3s linear infinite",
                "extra-spin-slow": "spin 20s linear infinite",
            },
            backgroundColor: {
                skin: {
                    fill: withOpacity('--color-fill'),
                    'button-accent': withOpacity('--color-button-accent'),
                    'button-accent-hover': withOpacity('--color-button-accent-hover'),
                    'button-muted': withOpacity('--color-button-muted'),
                }
            },
            gradientColorStops: {
                skin: {
                    hue: withOpacity('--color-fill'),
                },
            },
            colors: {
                info: colors.sky["500"],
                accent: "#5f5af6",
                "accent-focus": "#4d47f5",
                navy: navyColor,
                secondary: colors.slate,
                fila: "#fcf9f6",
                find: colors.orange,
                danger: colors.rose,
                primary: colors.amber,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },

    plugins: [require('@tailwindcss/typography'),
    require('flowbite/plugin'),
    require('daisyui'),
    require('@tailwindcss/forms')({
        strategy: 'class',
    }),


    require('@tailwindcss/aspect-ratio'),


    plugin(function ({ addUtilities, theme }) {
        const newUtilities = {
            '.custom-scrollbar': {
                '.custom-scrollbar::-webkit-scrollbar': { width: '6px' },
                '.custom-scrollbar::-webkit-scrollbar-track': { background: theme('bg-secondary') },
                '.custom-scrollbar::-webkit-scrollbar-thumb': { background: '#888' },
                '.custom-scrollbar::-webkit-scrollbar-thumb:hover': { background: '#555' },
            }
        }

        addUtilities(newUtilities, ['responsive', 'hover'])
    })],

};
