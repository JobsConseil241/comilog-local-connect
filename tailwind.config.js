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
                display: ['Geist', 'SF Pro Display', ...defaultTheme.fontFamily.sans],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['Geist Mono', ...defaultTheme.fontFamily.mono],
            },
            letterSpacing: {
                tightish: '-0.015em',
                tighter2: '-0.025em',
                widest2: '0.2em',
            },
            colors: {
                navy: {
                    DEFAULT: '#0A2240',
                    dark: '#061833',
                    light: '#1B3358',
                    50:  '#EEF2F8',
                    100: '#D6DEEC',
                    200: '#AEBDD9',
                    300: '#7E94BD',
                    400: '#4E6B9F',
                    500: '#2C4978',
                    600: '#1B3358',
                    700: '#0A2240',
                    800: '#061833',
                    900: '#030E20',
                },
                forest: {
                    DEFAULT: '#0F5132',
                    50:  '#ECFDF5',
                    100: '#D1FAE5',
                    200: '#A7F3D0',
                    300: '#6EE7B7',
                    400: '#34D399',
                    500: '#10B981',
                    600: '#15803D',
                    700: '#0F5132',
                    800: '#0A3E26',
                    900: '#062817',
                },
                bronze: {
                    DEFAULT: '#B45309',
                    50:  '#FFFBEB',
                    100: '#FEF3C7',
                    200: '#FDE68A',
                    300: '#FCD34D',
                    400: '#FBBF24',
                    500: '#F59E0B',
                    600: '#D97706',
                    700: '#B45309',
                    800: '#92400E',
                    900: '#78350F',
                },
                stone: {
                    50:  '#FAFAF9',
                    100: '#F5F5F4',
                    200: '#E7E5E4',
                    300: '#D6D3D1',
                    400: '#A8A29E',
                    500: '#78716C',
                    600: '#57534E',
                    700: '#44403C',
                    800: '#292524',
                    900: '#1C1917',
                    950: '#0C0A09',
                },
                success: '#15803D',
                danger: '#B91C1C',
                warning: '#CA8A04',
            },
            boxShadow: {
                'xs':       '0 1px 2px rgba(12,10,9,0.04)',
                'soft':     '0 1px 2px rgba(12,10,9,0.04), 0 1px 3px rgba(12,10,9,0.06)',
                'elevated': '0 4px 8px -2px rgba(12,10,9,0.08), 0 2px 4px -1px rgba(12,10,9,0.04)',
                'lifted':   '0 12px 24px -6px rgba(12,10,9,0.10), 0 4px 8px -2px rgba(12,10,9,0.06)',
                'floating': '0 24px 48px -12px rgba(12,10,9,0.18), 0 8px 16px -4px rgba(12,10,9,0.08)',
                'glow-bronze': '0 0 0 1px rgba(180,83,9,0.10), 0 8px 24px -8px rgba(180,83,9,0.45)',
                'glow-bronze-lg': '0 0 0 1px rgba(180,83,9,0.20), 0 16px 40px -8px rgba(180,83,9,0.55), 0 0 80px -20px rgba(245,158,11,0.40)',
                'glow-navy':   '0 0 60px -12px rgba(27,51,88,0.40)',
                'glow-forest': '0 0 50px -10px rgba(21,128,61,0.30)',
                'inner-glow':  'inset 0 1px 0 0 rgba(255,255,255,0.10)',
            },
            backgroundImage: {
                'hero-navy-forest': 'linear-gradient(135deg, #0A2240 0%, #1B3358 50%, #0F5132 100%)',
                'cta-bronze': 'linear-gradient(135deg, #D97706 0%, #B45309 100%)',
                'soft-glow-bronze': 'radial-gradient(closest-side, rgba(245,158,11,0.25), transparent 70%)',
                'soft-glow-navy': 'radial-gradient(closest-side, rgba(27,51,88,0.25), transparent 70%)',
                'soft-glow-forest': 'radial-gradient(closest-side, rgba(21,128,61,0.20), transparent 70%)',
                'noise': "url(\"data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E\")",
                'grid-stone': "linear-gradient(rgba(231,229,228,.6) 1px, transparent 1px), linear-gradient(90deg, rgba(231,229,228,.6) 1px, transparent 1px)",
            },
            backgroundSize: {
                'grid': '32px 32px',
            },
            animation: {
                'fade-up': 'fade-up 600ms cubic-bezier(0.16, 1, 0.3, 1) both',
                'glow-pulse': 'glow-pulse 6s ease-in-out infinite',
                'float-slow': 'float-slow 12s ease-in-out infinite',
                'shimmer': 'shimmer 2s linear infinite',
            },
            keyframes: {
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(12px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'glow-pulse': {
                    '0%, 100%': { opacity: '0.6' },
                    '50%': { opacity: '1' },
                },
                'float-slow': {
                    '0%, 100%': { transform: 'translate(0, 0) scale(1)' },
                    '50%': { transform: 'translate(-20px, 30px) scale(1.05)' },
                },
                'shimmer': {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
            transitionTimingFunction: {
                'expo-out': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
        },
    },

    plugins: [forms],
};
