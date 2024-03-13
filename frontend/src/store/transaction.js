// Utilities
import { defineStore } from 'pinia'

export const useTransactionStore = defineStore('transaction', {
  state: () => ({
    purchaseDialog: false,
    depositDialog: false,
    refreshDashboard: false,
    currentPage: 1,
  }),
  actions: {
    setPurchaseDialog(value) {
      this.purchaseDialog = value;
    },
    setDepositDialog(value) {
      this.depositDialog = value;
    },
    setRefreshDashboard(value) {
      this.refreshDashboard = value;
    },
    setCurrentPage(value) {
      this.currentPage = value;
    }
  }
})
