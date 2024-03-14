// Utilities
import { defineStore } from 'pinia'

export const useAdminStore = defineStore('admin', {
  state: () => ({
    approvalDialog: false,
    selectedTransaction: null,
    currentCheck: null,
    refreshAdmin: false,
    loadingUpdate: false,
  }),
  actions: {
    prepareApprovalDialog(value, id) {
      this.approvalDialog = value;
      this.selectedTransaction = id;
    },
    setCurrentCheck(value) {
      this.currentCheck = value;
    },
    setRefreshAdmin(value) {
      this.refreshAdmin = value;
    },
    setLoadingUpdate(value) {
      this.loadingUpdate = value;
    },
    unsetSelectedTransaction() {
      this.selectedTransaction = null;
    },
  }
})
