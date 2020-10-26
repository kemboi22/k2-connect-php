<?php

namespace Kopokopo\SDK;

require 'vendor/autoload.php';

use Kopokopo\SDK\Requests\MerchantBankAccountRequest;
use Kopokopo\SDK\Requests\MerchantWalletRequest;
use Kopokopo\SDK\Requests\SettleFundsRequest;
use Kopokopo\SDK\Requests\StatusRequest;
use Exception;

class SettlementTransferService extends Service
{
    public function createMerchantBankAccount($options)
    {
        $merchantBankAccountRequest = new MerchantBankAccountRequest($options);
        try {
            $response = $this->client->post('merchant_bank_accounts', ['body' => json_encode($merchantBankAccountRequest->getSettlementAccountBody()), 'headers' => $merchantBankAccountRequest->getHeaders()]);

            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function createMerchantWallet($options)
    {
        $merchantWalletRequest = new MerchantWalletRequest($options);
        try {
            $response = $this->client->post('merchant_wallets', ['body' => json_encode($merchantWalletRequest->getSettlementAccountBody()), 'headers' => $merchantWalletRequest->getHeaders()]);

            return $this->postSuccess($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function settleFunds($options)
    {
        $settleFundsRequest = new SettleFundsRequest($options);
        try {
            $response = $this->client->post('settlement_transfers', ['body' => json_encode($settleFundsRequest->getSettleFundsBody()), 'headers' => $settleFundsRequest->getHeaders()]);

            return $this->postSuccess($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function settlementStatus($options)
    {
        $settlementStatus = new StatusRequest($options);
        try {
            $response = $this->client->get('transfer_status', ['query' => $settlementStatus->getLocation(), 'headers' => $settlementStatus->getHeaders()]);

            return $this->success($response);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
