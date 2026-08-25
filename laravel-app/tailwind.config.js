/** @type {import('tailwindcss').Config} */
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
        './app/Filament/**/*.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#eef4ff',
                    100: '#dbe6ff',
                    200: '#bcd1ff',
                    300: '#8fb3ff',
                    400: '#5c8bff',
                    500: '#3767ff',
                    600: '#1f4bff',
                    700: '#1d3fe6',
                    800: '#1c37b6',
                    900: '#1e358f',
                    950: '#131f5a',
                },
                ink: {
                    900: '#0b1220',
                    800: '#111a2e',
                    700: '#1c2540',
                    500: '#4a5573',
                    400: '#6b7590',
                    300: '#94a0bd',
                    200: '#c3cbe0',
                    100: '#e6ebf5',
                    50:  '#f5f7fc',
                },
                accent: {
                    yellow: '#f5b544',
                    green:  '#5bc17a',
                    purple: '#a074e8',
                    pink:   '#f37aa5',
                },
            },
            fontFamily: {
                sans: ['"Instrument Sans"', 'Manrope', ...defaultTheme.fontFamily.sans],
                display: ['"Instrument Serif"', 'Manrope', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                'xl2': '1.25rem',
                '3xl': '1.75rem',
            },
            boxShadow: {
                'card':   '0 4px 24px -8px rgba(19, 31, 90, 0.10)',
                'cardLg': '0 12px 40px -12px rgba(19, 31, 90, 0.18)',
            },
            maxWidth: {
                '8xl': '88rem',
            },
            keyframes: {
                float: {
                '0%, 100%': { transform: 'translateY(0px)' },
                '50%': { transform: 'translateY(-10px)' },
                },
                'float-delayed': {
                '0%, 100%': { transform: 'translateY(0px)' },
                '50%': { transform: 'translateY(10px)' },
                }
            },
            animation: {
                float: 'float 4s ease-in-out infinite',
                'float-delayed': 'float-delayed 5s ease-in-out infinite 1s',
            }
        },
    },
    plugins: [forms, typography],
};
