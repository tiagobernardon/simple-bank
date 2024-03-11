// Utilities
import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    drawer: true
  }),
  actions: {
    setDrawer(value) {
      this.drawer = value;
    }
  }
})
