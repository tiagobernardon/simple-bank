// Utilities
import { defineStore } from 'pinia'

export const useAdminStore = defineStore('admin', {
  state: () => ({
    approvalDialog: false,
    selectedTransaction: null,
    currentCheck: null,
  }),
  actions: {
    prepareApprovalDialog(value, id) {
      this.approvalDialog = value;
      this.selectedTransaction = id;
    },
    setCurrentCheck(value) {
      this.currentCheck = value;
    },
    unsetSelectedTransaction() {
      this.selectedTransaction = null;
    },
  }
})
