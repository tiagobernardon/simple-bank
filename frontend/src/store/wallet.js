// Utilities
import { defineStore } from 'pinia'

export const useWalletStore = defineStore('wallet', {
  state: () => ({
    balance: 0.00,
  }),
  actions: {
    setBalance(value) {
      this.balance = value;
    },
  }
})
