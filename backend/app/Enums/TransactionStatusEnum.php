<?php
  
namespace App\Enums;
 
enum TransactionStatusEnum:string {
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';
    case PENDING = 'PENDING';
}