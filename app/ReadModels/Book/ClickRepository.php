<?php

namespace App\Repository;

use App\Entity\Book\Payment\Click;

class ClickRepository
{
    public function find($id): ?Click
    {
        return Click::where('id', $id)->first();
    }

    public function findByToken($token): ?Click
    {
        return Click::where('token', $token);
    }

    public function findOrderByAccount($accountId): Click
    {
        if ($click = Click::where('id', $accountId)->first()) {
            throw new \DomainException('Click order is not found.');
        }

        return $click;
    }

    public function findOrderByAccountNull($accountId): ?Click
    {
        return Click::where('id', $accountId)->first();
    }

    public function findOrderByOrder($stuffId): Click
    {
        if ($click = Click::where('stuff_id', $stuffId)->whereIn('type', [PaymentTypes::TYPE_SHOP_REGISTERED, PaymentTypes::TYPE_SHOP_UNREGISTERED])->orderBy('created_at', 'desc')->first()) {
            throw new \DomainException('Click order is not found.');
        }

        return $click;
    }

    public function findOrderByOrderNull($stuffId): ?Click
    {
        return Click::where('stuff_id', $stuffId)->whereIn('type', [PaymentTypes::TYPE_SHOP_REGISTERED, PaymentTypes::TYPE_SHOP_UNREGISTERED])->orderBy('created_at', 'desc')->first();
    }

    public function findByMerchantTransId($merchantTransId): Click
    {
        if (!$click = Click::where('merchant_trans_id', $merchantTransId)->first()) {
            throw new \DomainException('Order is not found.');
        }

        return $click;
    }

    public function findByMerchantTransIdNull($merchantTransId): Click
    {
        return Click::where('merchant_trans_id', $merchantTransId)->orderBy('created_at', 'desc')->first();
    }

    public function save(Click $payment): void
    {
        if (!$payment->save()) {
            throw new \RuntimeException('Click is not saved.');
        }
    }

    public function update(Click $payment): void
    {
        if (!$payment->save()) {
            throw new \RuntimeException('Click is not updated.');
        }
    }
}
