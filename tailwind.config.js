import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Official Company Brand Palette
                // 1. Primary Brand: Navy 900 #14263F (Top bar, footers, dark backgrounds, high-contrast text)
                primary: {
                    DEFAULT: '#14263F',
                    900: '#14263F',
                    800: '#1A304F',
                    700: '#1F3A5F',
                },
                navy: {
                    950: '#0E1A2B',
                    900: '#14263F', // Primary Brand (Top bar, footers, dark backgrounds, high-contrast text)
                    800: '#1A304F',
                    700: '#1F3A5F', // Secondary Brand (Headings, primary links, active borders, text selections)
                    600: '#274B7A',
                    500: '#335E99',
                    100: '#E7ECF3',
                    50: '#F2F5F8',
                },
                // 2. Secondary Brand: Navy 700 #1F3A5F (Headings, primary links, active borders, text selections)
                secondary: {
                    DEFAULT: '#1F3A5F',
                    700: '#1F3A5F',
                },
                // 3 & 4. Action / Accent: Orange 500 #E8833A & Action Hover: Orange 600 #D2702A
                action: {
                    DEFAULT: '#E8833A',
                    500: '#E8833A', // Primary CTA buttons, highlight badges, accents
                    600: '#D2702A', // Button hover & active states
                    hover: '#D2702A',
                    50: '#FDF6F0',
                    100: '#FBECDF',
                },
                accent: {
                    DEFAULT: '#E8833A',
                    hover: '#D2702A',
                },
                orange: {
                    50: '#FDF6F0',
                    100: '#FBECDF',
                    200: '#F7D6BD',
                    300: '#F1B892',
                    400: '#EC9960',
                    500: '#E8833A', // Action / Accent Orange 500 rgb(232, 131, 58)
                    600: '#D2702A', // Action Hover Orange 600 rgb(210, 112, 42)
                    700: '#AF571F',
                    800: '#8C4217',
                    900: '#692F10',
                },
                // 5. Page Background: Warm Off-White #F7F6F2 (Main website background, light sections)
                page: '#F7F6F2',
                'off-white': '#F7F6F2',
                // 6. Surface: Pure White #FFFFFF (Card backgrounds, inputs, modals)
                surface: '#FFFFFF',
                // 7. Border / Divider: Muted Sand #E3E0D8 (Card borders, table dividers, form input borders)
                borderMuted: '#E3E0D8',
                sand: {
                    DEFAULT: '#E3E0D8',
                    50: '#FAF9F7',
                    100: '#F7F6F2', // Warm Off-White
                    200: '#EFECE6',
                    300: '#E3E0D8', // Muted Sand
                    400: '#C7C2B6',
                    500: '#ABA495',
                },
                // 8. Body Text: Slate Charcoal #3B4656 (Standard body paragraph text)
                bodyText: '#3B4656',
                charcoal: {
                    DEFAULT: '#3B4656',
                    900: '#1D232B',
                    800: '#2A333E',
                    700: '#3B4656', // Slate Charcoal rgb(59, 70, 86)
                    600: '#4D5B6F',
                    500: '#607188',
                },
                // 9. Muted Text: Cool Slate #6B7686 (Subtitles, meta info, placeholders, labels)
                mutedText: '#6B7686',
                coolslate: {
                    DEFAULT: '#6B7686',
                    600: '#586270',
                    500: '#6B7686', // Cool Slate rgb(107, 118, 134)
                    400: '#8893A2',
                    300: '#ACB4C0',
                    200: '#D1D6DD',
                    100: '#E9ECF0',
                },
                // 10. Success / Valid: Forest Green #2F7D5B (Success badges, checkmarks, confirmation notices)
                success: {
                    DEFAULT: '#2F7D5B',
                    500: '#2F7D5B', // Forest Green rgb(47, 125, 91)
                    600: '#256649',
                    700: '#1C4E38',
                    100: '#DBEDE4',
                    50: '#F0F7F4',
                },
                forest: {
                    DEFAULT: '#2F7D5B',
                    500: '#2F7D5B',
                    600: '#256649',
                    700: '#1C4E38',
                    100: '#DBEDE4',
                    50: '#F0F7F4',
                },
                // 11. Danger / Error: Brick Red #B3392F (Error messages, form validation errors)
                danger: {
                    DEFAULT: '#B3392F',
                    500: '#B3392F', // Brick Red rgb(179, 57, 47)
                    600: '#992E25',
                    700: '#7F241C',
                    100: '#F8E2E0',
                    50: '#FCF3F2',
                },
                brick: {
                    DEFAULT: '#B3392F',
                    500: '#B3392F',
                    600: '#992E25',
                    700: '#7F241C',
                    100: '#F8E2E0',
                    50: '#FCF3F2',
                },
                // Semantic company brand token map
                brand: {
                    primary: '#14263F',        // Navy 900
                    secondary: '#1F3A5F',      // Navy 700
                    action: '#E8833A',         // Orange 500
                    'action-hover': '#D2702A', // Orange 600
                    bg: '#F7F6F2',             // Warm Off-White
                    surface: '#FFFFFF',        // Pure White
                    border: '#E3E0D8',         // Muted Sand
                    body: '#3B4656',           // Slate Charcoal
                    muted: '#6B7686',          // Cool Slate
                    success: '#2F7D5B',        // Forest Green
                    danger: '#B3392F',         // Brick Red
                },

                // Seamless project-wide overrides for existing template classes
                indigo: {
                    50: '#FDF6F0',
                    100: '#FBECDF',
                    200: '#F7D6BD',
                    300: '#F1B892',
                    400: '#EC9960',
                    500: '#1F3A5F', // Navy 700
                    600: '#E8833A', // Orange 500 (Primary CTA)
                    700: '#D2702A', // Orange 600 (Action Hover)
                    800: '#1F3A5F', // Navy 700
                    900: '#14263F', // Navy 900
                    950: '#0E1A2B',
                },
                slate: {
                    50: '#F7F6F2',  // Page Background: Warm Off-White #F7F6F2
                    100: '#F0EFEA',
                    200: '#E3E0D8', // Border / Divider: Muted Sand #E3E0D8
                    300: '#D1CDC3',
                    400: '#8A94A3',
                    500: '#6B7686', // Muted Text: Cool Slate #6B7686
                    600: '#6B7686', // Muted Text: Cool Slate #6B7686
                    700: '#3B4656', // Body Text: Slate Charcoal #3B4656
                    800: '#1F3A5F', // Secondary Brand: Navy 700 #1F3A5F
                    900: '#14263F', // Primary Brand: Navy 900 #14263F
                    950: '#0E1A2B',
                },
                emerald: {
                    50: '#F0F7F4',
                    100: '#DBEDE4',
                    200: '#B8DCCB',
                    300: '#84C2A5',
                    400: '#4DA77E',
                    500: '#2F7D5B', // Success: Forest Green #2F7D5B
                    600: '#256649',
                    700: '#1C4E38',
                    800: '#163E2D',
                    900: '#102E21',
                },
                rose: {
                    50: '#FCF3F2',
                    100: '#F8E2E0',
                    200: '#F2C7C3',
                    300: '#E7A19B',
                    400: '#D8736B',
                    500: '#B3392F', // Danger: Brick Red #B3392F
                    600: '#992E25',
                    700: '#7F241C',
                    800: '#651C15',
                    900: '#4B140F',
                },
                red: {
                    50: '#FCF3F2',
                    100: '#F8E2E0',
                    200: '#F2C7C3',
                    300: '#E7A19B',
                    400: '#D8736B',
                    500: '#B3392F', // Danger: Brick Red #B3392F
                    600: '#992E25',
                    700: '#7F241C',
                    800: '#651C15',
                    900: '#4B140F',
                },
            },
        },
    },

    plugins: [forms],
};
