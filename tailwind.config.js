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


/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    presets: [preset],
    mode: 'jit',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
       './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
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

        },
    },


    plugins: [forms, require('@tailwindcss/aspect-ratio'), require('flowbite/plugin'), require("daisyui")],

};
