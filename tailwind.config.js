import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Poppins', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                btn: '8px',
                card: '14px',
            },
            colors: {
                /* ==========================================================
                   Exact Freeya Service Official Brand Color Palette
                   ========================================================== */
                // Primary: Burgundy #7B1E3A (Logo, main buttons, links, key headings)
                burgundy: {
                    DEFAULT: '#7B1E3A',
                    50: '#FDF2F5',
                    100: '#FCE7EC',
                    200: '#F7C4D0',
                    300: '#F196AD',
                    400: '#E65D82',
                    500: '#7B1E3A',
                    600: '#64172E',
                    700: '#5A1429', // Primary dark
                    800: '#4D1022',
                    900: '#3D0B1A',
                    dark: '#5A1429',
                    deep: '#5A1429',
                },
                // Primary Dark / Dark sections / Footer: Deep burgundy #5A1429
                navy: {
                    DEFAULT: '#5A1429', // Dark sections & footer map to Deep burgundy #5A1429
                    950: '#3D0B1A',
                    900: '#4D1022',
                    800: '#5A1429',
                    700: '#64172E',
                    600: '#7B1E3A',
                    500: '#7B1E3A',
                    100: '#F3E3E6',
                    50: '#FAF5F2',
                },
                // Accent: Champagne gold #C9A24B (Small highlights, badges, icons, underlines)
                gold: {
                    DEFAULT: '#C9A24B',
                    50: '#FAF6ED',
                    100: '#F5ECDA',
                    200: '#EBD8B3',
                    300: '#DFC28A',
                    400: '#D5B267',
                    500: '#C9A24B',
                    600: '#B08A37',
                    700: '#8C6C27',
                    800: '#684F1B',
                    900: '#4A3711',
                },
                champagne: {
                    DEFAULT: '#C9A24B',
                    500: '#C9A24B',
                },
                teal: {
                    DEFAULT: '#C9A24B', // Mapped to Accent Champagne Gold #C9A24B
                    light: '#C9A24B',
                    50: '#FAF6ED',
                    100: '#F5ECDA',
                    200: '#EBD8B3',
                    300: '#DFC28A',
                    400: '#D5B267',
                    500: '#C9A24B',
                    600: '#B08A37',
                    700: '#8C6C27',
                },
                // Background: Warm cream #FAF5F2 (Main page background)
                cream: {
                    DEFAULT: '#FAF5F2',
                    50: '#FFFFFF',
                    100: '#FAF5F2',
                    200: '#F5ECE7',
                    300: '#EFE0D9',
                },
                sand: {
                    DEFAULT: '#FAF5F2', // Warm cream #FAF5F2
                    50: '#FFFFFF',
                    100: '#FAF5F2',
                    200: '#F3E3E6',
                    300: '#E4D6D9',
                },
                // Surface: Soft blush #F3E3E6 (Cards, alternating sections, form fields)
                blush: {
                    DEFAULT: '#F3E3E6',
                    50: '#FAF3F5',
                    100: '#F3E3E6',
                    200: '#E8CCD2',
                    300: '#DCB3BD',
                },
                // Text: Charcoal wine #1F1519 (Headings and body text)
                charcoal: {
                    DEFAULT: '#1F1519',
                    950: '#120B0E',
                    900: '#1F1519',
                    800: '#2E2025',
                    700: '#423137',
                },
                ink: {
                    DEFAULT: '#1F1519',
                    950: '#120B0E',
                    900: '#1F1519',
                    800: '#2E2025',
                    700: '#423137',
                    600: '#57424A',
                    500: '#6B5E62',
                    100: '#F3E3E6',
                    50: '#FAF5F2',
                },
                // Muted text: Warm gray #6B5E62 (Subtitles, captions, placeholders)
                warmgray: {
                    DEFAULT: '#6B5E62',
                    500: '#6B5E62',
                    600: '#574C50',
                    700: '#433B3E',
                },
                // Border: Light rose gray #E4D6D9 (Dividers, input borders)
                rosegray: {
                    DEFAULT: '#E4D6D9',
                    100: '#F2EBED',
                    200: '#E4D6D9',
                    300: '#D2BFC3',
                },
                mist: {
                    DEFAULT: '#E4D6D9', // Light rose gray #E4D6D9
                    50: '#FAF5F2',
                    100: '#F3E3E6',
                    200: '#E4D6D9',
                    300: '#D2BFC3',
                },
                // Success: Green #2E7D5B ("Available now" or "Staff ready" status dots)
                success: {
                    DEFAULT: '#2E7D5B',
                    50: '#EDF7F2',
                    100: '#D6EFE2',
                    500: '#2E7D5B',
                    600: '#246549',
                    700: '#1B4D37',
                },
                green: {
                    DEFAULT: '#2E7D5B',
                    50: '#EDF7F2',
                    100: '#D6EFE2',
                    500: '#2E7D5B',
                    600: '#246549',
                },
                forest: {
                    DEFAULT: '#2E7D5B',
                    50: '#EDF7F2',
                    100: '#D6EFE2',
                    500: '#2E7D5B',
                },
                white: '#FFFFFF',

                /* Dark Mode Palette Tokens */
                dark: {
                    bg: '#3D0B1A',
                    card: '#5A1429',
                    text: '#FAF5F2',
                    muted: '#E4D6D9',
                    border: '#64172E',
                    link: '#C9A24B',
                },

                /* Semantic Brand Tokens */
                brand: {
                    primary: '#7B1E3A',        // Burgundy #7B1E3A
                    'primary-dark': '#5A1429', // Deep burgundy #5A1429
                    secondary: '#7B1E3A',      // Burgundy #7B1E3A
                    action: '#7B1E3A',         // Burgundy #7B1E3A
                    'action-hover': '#5A1429', // Deep burgundy #5A1429
                    accent: '#C9A24B',         // Champagne gold #C9A24B
                    gold: '#C9A24B',           // Champagne gold #C9A24B
                    teal: '#C9A24B',           // Champagne gold #C9A24B
                    'teal-light': '#C9A24B',   // Champagne gold #C9A24B
                    bg: '#FAF5F2',             // Warm cream #FAF5F2
                    surface: '#F3E3E6',        // Soft blush #F3E3E6
                    card: '#F3E3E6',           // Soft blush #F3E3E6
                    border: '#E4D6D9',         // Light rose gray #E4D6D9
                    body: '#1F1519',           // Charcoal wine #1F1519
                    text: '#1F1519',           // Charcoal wine #1F1519
                    muted: '#6B5E62',          // Warm gray #6B5E62
                    success: '#2E7D5B',        // Green #2E7D5B
                    danger: '#5A1429',         // Deep burgundy #5A1429
                },

                /* Aliases to map legacy template utilities into the new brand palette */
                primary: {
                    DEFAULT: '#7B1E3A',
                    dark: '#5A1429',
                    50: '#FDF2F5',
                    500: '#7B1E3A',
                    700: '#5A1429',
                    800: '#4D1022',
                    900: '#3D0B1A',
                },
                secondary: {
                    DEFAULT: '#1F1519',
                    700: '#1F1519',
                    800: '#1F1519',
                    900: '#1F1519',
                },
                action: {
                    DEFAULT: '#7B1E3A',
                    hover: '#5A1429',
                    50: '#FDF2F5',
                    100: '#FCE7EC',
                    500: '#7B1E3A',
                    600: '#5A1429',
                },
                orange: {
                    DEFAULT: '#7B1E3A',
                    500: '#7B1E3A',
                    600: '#5A1429',
                },
                amber: {
                    DEFAULT: '#C9A24B',
                    500: '#C9A24B',
                    600: '#B08A37',
                },
                yellow: {
                    DEFAULT: '#C9A24B',
                    500: '#C9A24B',
                    600: '#B08A37',
                },
                brick: {
                    DEFAULT: '#5A1429',
                    500: '#5A1429',
                },
                danger: {
                    DEFAULT: '#5A1429',
                    500: '#5A1429',
                },
                red: {
                    DEFAULT: '#7B1E3A',
                    500: '#7B1E3A',
                    600: '#5A1429',
                },
                rose: {
                    DEFAULT: '#7B1E3A',
                    500: '#7B1E3A',
                    600: '#5A1429',
                },
            },
        },
    },

    plugins: [forms],
};
