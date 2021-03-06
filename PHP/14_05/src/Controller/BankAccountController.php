<?php

namespace App\Controller;

use App\Account;
use App\Bank;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BankAccountController extends AbstractController
{
    /**@Route('/bank/account', name: 'bank_account')
    *
    */
    public function index(): Response
    {
      $bank = new Bank();
      $firstAccount = new Account(1000, 12345);
      $secondAccount = new Account(1000, 123);
      $thirdAccount = new Account(1000, 9999);
      $bank->addAccount($firstAccount);
      $bank->addAccount($secondAccount);
      $bank->addAccount($thirdAccount);

      $bank->getAccountById(9999)->deposit(-1000);//N
      $bank->getAccountById(9999)->deposit(1000);//Y
      $bank->getAccountById(123)->withdraw(-10000);//N
      $bank->getAccountById(123)->withdraw(10000);//impossibru
      $bank->getAccountById(123)->withdraw(1000);//Y
        return $this->json([
            'bank_id' => 12345,
            'balance' => $bank->getAccountById(12345)->getBalance()
        ]);
    }
}
