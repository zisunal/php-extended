<?php

namespace Zisunal\PhpExtended;

use Zisunal\PhpExtended\Interfaces\CurrencyInterface;

class Currency implements CurrencyInterface 
{
    /**
     * @var string The name of the currency.
     */
    private $name;

    /**
     * @var string The ISO code of the currency.
     */
    private $iso;

    /**
     * @var string The symbol of the currency.
     */
    private $symbol;

    /**
     * @var float The exchange rate of the currency.
     */
    private $exchange_rate;

    /**
     * @var array The array of transactions for the currency.
     */
    private $transactions = [];

    /**
     * @var array The array of conversion histories for the currency.
     */
    private $converts = [];
    
    private function generate_trx_id(): string
    {
        return md5(uniqid());
    }
    public function __construct(string $name, string $iso, string $symbol, float $exchange_rate)
    {
        $this->name = (string) $name;
        $this->iso = (string) $iso;
        $this->symbol = (string) $symbol;
        $this->exchange_rate = (float) $exchange_rate;
    }
    public function get_meta(): array
    {
        return [
            'name' => $this->name,
            'iso' => $this->iso,
            'symbol' => $this->symbol,
            'exchangeRate' => $this->exchange_rate
        ];
    }
    public function add_transaction (int|float $amount, bool $type = true): self
    {
        if (!$type && $amount > $this->balance()) {
            throw new \InvalidArgumentException("Insufficient balance to perform debit transaction of $amount {$this->iso}.");
        }
        $date = date('Y-m-d H:i:s');
        $this->transactions[] = [
            'id' => $this->generate_trx_id(),
            'amount' => $amount,
            'type' => $type ? 'credit' : 'debit',
            'date' => $date
        ];
        return $this;
    }
    public function get_transactions(): ?array
    {
        return $this->transactions;
    }
    public function get_transaction(string $id): ?array
    {
        foreach ($this->transactions as $trx) {
            if ($trx['id'] == $id) {
                return $trx;
            }
        }
        return null;
    }
    public function convert_to(Currency $to, int|float $amount): int|float
    {
        $converted_amount = round($amount * (1 / $to->exchange_rate) * $this->exchange_rate, 2);
        $this->converts[] = [
            'from' => $this->iso,
            'to' => $to->iso,
            'amount' => $amount,
            'convertedAmount' => $converted_amount
        ];
        return $converted_amount;
    }
    public function convert_histories()
    {
        return $this->converts;
    }
    public function credit_sum(): int|float|null
    {
        $total = 0;
        foreach ($this->transactions as $trx) {
            if ($trx['type'] == 'credit') {
                $total += $trx['amount'];
            }
        }
        return $total;
    }
    public function debit_sum(): int|float|null
    {
        $total = 0;
        foreach ($this->transactions as $trx) {
            if ($trx['type'] == 'debit') {
                $total += $trx['amount'];
            }
        }
        return $total;
    }
    public function balance(): int|float|null
    {
        return $this->credit_sum() - $this->debit_sum();
    }
    public function get_name(): string
    {
        return $this->name;
    }
    public function get_iso(): string
    {
        return $this->iso;
    }
    public function get_symbol(): string
    {
        return $this->symbol;
    }
}