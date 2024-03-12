<?php
  
namespace App\Enums;
 
enum TransactionTypeEnum:string {
    case Purchase = 'PURCHASE';
    case Deposit = 'DEPOSIT';
}