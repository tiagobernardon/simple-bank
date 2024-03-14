// Utilities
import { defineStore } from 'pinia'

export const useAdminStore = defineStore('admin', {
  state: () => ({
    approvalDialog: false,
  }),
  actions: {
    setApprovalDialog(value) {
      this.approvalDialog = value;
    },
  }
})
