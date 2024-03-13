import { PURCHASE, DEPOSIT } from '@/utils/transactions/transactionTypes.js';
import { APPROVED, REJECTED, PENDING } from '@/utils/transactions/transactionStatuses.js';

export const formatTypeText = value => {
  let text = ''

  switch (value) {
    case PURCHASE:
        text = 'Purchase';
        break;
    case DEPOSIT:
        text = 'Deposit';
        break;
  }

  return text;
};

export const formatTypeColor = value => {
  let color = ''

  switch (value) {
    case PURCHASE:
        color = 'primary';
        break;
    case DEPOSIT:
        color = 'success';
        break;
  }

  return color;
};

export const formatStatusText = value => {
  let text = ''

  switch (value) {
    case APPROVED:
        text = 'Approved';
        break;
    case REJECTED:
        text = 'Rejected';
        break;
    case PENDING:
        text = 'Pending';
        break;
  }

  return text;
};

export const formatStatusColor = value => {
  let color = ''

  switch (value) {
    case APPROVED:
        color = 'success';
        break;
    case REJECTED:
        color = 'error';
        break;
    case PENDING:
        color = 'secondary';
        break;
  }

  return color;
};

export const formatCurrency = value => {
  return parseFloat(value).toLocaleString('en-US', { style: 'currency', currency: 'USD' });
};

export const formatDate = value => {
  return new Date(value).toLocaleString('en-US');
};