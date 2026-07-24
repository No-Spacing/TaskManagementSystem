import Aura from '@primevue/themes/aura';
import { definePreset } from '@primevue/themes';

export const MyCustomTheme = definePreset(Aura, {
  semantic: {
    primary: {
      50: '#e7f7fc',
      100: '#9ceeea',
      200: '#21eba7',
      500: '#1bd6cd',
      600: '#0b8b85',
      700: '#07ad92',
    },
  },
});