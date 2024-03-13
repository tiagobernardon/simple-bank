// Utilities
import { defineStore } from 'pinia'

export const useAppStore = defineStore('app', {
  state: () => ({
    user: localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : {},
    drawer: false,
    snackbar: {
      show: false,
      error: false,
      message: ''
    },
    purchaseDialog: false,
    depositDialog: false
  }),
  actions: {
    setDrawer(value) {
      this.drawer = value;
    },
    setUser(value) {
      this.user = value;
    },
    setSnackbar(value) {
      this.snackbar = value;
    },
    setPurchaseDialog(value) {
      this.purchaseDialog = value;
    },
    setDepositDialog(value) {
      this.depositDialog = value;
    }
  }
})
