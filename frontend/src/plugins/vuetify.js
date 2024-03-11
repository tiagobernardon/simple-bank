/**
 * plugins/vuetify.js
 *
 * Framework documentation: https://vuetifyjs.com`
 */

// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'

// Composables
import { createVuetify } from 'vuetify'

// https://vuetifyjs.com/en/introduction/why-vuetify/#feature-guides
export default createVuetify({
  theme: {
    themes: {
      light: {
        colors: {
          background: "#f5f5f5",
          surface: "#ffffff",
          primary: "#1976d2",
          secondary: "#424242",
          error: "#ff5252",
          info: "#2196f3",
          success: "#4caf50",
          warning: "#ffc107"
        },
      },
    },
  },
})
