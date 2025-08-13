<?php

namespace Zisunal\PhpExtended\Interfaces;

use Zisunal\PhpExtended\Currency;

interface CurrencyInterface
{
    /**
     * Constructs a new Currency object.
     *
     * ```php
     * <?php
     * use Zisunal\PhpExtended\Currency;
     *
     * $money = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * ```
     * @param string $name The name of the currency.
     * @param string $iso The ISO code of the currency.
     * @param string $symbol The symbol of the currency.
     * @param float $exchange_rate The exchange rate of the currency with USD. If 1 USD = 125 BDT, then $exchange_rate of BDT = 0.008.
     */
    public function __construct(string $name, string $iso, string $symbol, float $exchange_rate);
    /**
     * Returns the metadata of the currency.
     *
     * ```php
     * <?php
     * $money = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $meta = $money->get_meta();
     *
     * // Will return ['name' => 'Bangladeshi Taka', 'iso' => 'BDT', 'symbol' => '৳', 'exchange_rate' => 0.008]
     * ```
     * @return array The metadata of the currency.
     */
    public function get_meta(): array;

    /**
     * Adds a transaction to the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $taka = $bdt->add_transaction(100, true)->add_transaction(50, false);
     *
     * // $taka will contain the updated currency object.
     * ```
     * @param int|float $amount The amount of the transaction.
     * @param bool $credit The type of the transaction. True for credit, false for debit. Default: true
     * @return self
     */
    public function add_transaction (int|float $amount, bool $credit = true): self;

    /**
     * Generates a unique transaction ID.
     *
     * @return string The generated transaction ID.
     */
    private function generate_trx_id(): string;

    /**
     * Returns all transactions of the currency.
     *
     * ```php
     * <?php
     * $money = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $money->add_transaction(1000)->add_transaction(500, false);
     * $transactions = $money->get_transactions();
     *
     * // $transactions will contain all transactions in an array [
     *   ['id' => 'trx_1', 'amount' => 1000, 'type' => 'credit', 'date' => '2025-08-15 17:00:00'],
     *   ['id' => 'trx_2', 'amount' => 500, 'type' => 'debit', 'date' => '2025-08-15 17:00:00'],
     * ].
     * ```
     * @return array|null The array of transactions.
     */
    public function get_transactions(): ?array;

    /**
     * Returns a specific transaction by its ID.
     *
     * ```php
     * <?php
     * $transaction = $money->get_transaction('trx_1');
     * // $transaction will contain the transaction details of 'trx_1' in an array ['id' => 'trx_1', 'amount' => 1000, 'type' => 'credit', 'date' => '2025-08-15 17:00:00']
     * ```
     * @param string $id The ID of the transaction.
     * @return array|null The transaction with the specified ID, or null if not found.
     */
    public function get_transaction(string $id): ?array;

    /**
     * Converts an amount of the currency to another currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $pound = new Currency('British Pound', 'GBP', '£', 1.35);
     * $converted = $bdt->convert_to($pound, 1000);
     *
     * // $converted will contain the converted amount in GBP.
     * ```
     * @param Currency $to The target currency to convert to.
     * @param int|float $amount The amount to convert.
     * @return int|float The converted amount.
     */
    public function convert_to(Currency $to, int|float $amount): int|float;

    /**
     * Returns the conversion histories of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $pound = new Currency('British Pound', 'GBP', '£', 1.35);
     * $bdt->convert_to($pound, 1000);
     *
     * $histories = $bdt->convert_histories();
     * ```
     * @return array The array of conversion histories.
     */
    public function convert_histories();

    /**
     * Returns the total credit amount of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $bdt->add_transaction(1000);
     * $bdt->add_transaction(500, false);
     * $credit = $bdt->credit_sum();
     *
     * // $credit will contain 1000
     * ```
     * @return int|float|null The total credit amount.
     */
    public function credit_sum(): int|float|null;

    /**
     * Returns the total debit amount of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $bdt->add_transaction(1000);
     * $bdt->add_transaction(500, false);
     * $debit = $bdt->debit_sum();
     *
     * // $debit will contain 500
     * ```
     * @return int|float|null The total debit amount.
     */
    public function debit_sum(): int|float|null;

    /**
     * Returns the total balance of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $bdt->add_transaction(1000);
     * $bdt->add_transaction(500, false);
     * $balance = $bdt->balance();
     *
     * // $balance will contain 500
     * ```
     * @return int|float|null The total balance.
     */
    public function balance(): int|float|null;

    /**
     * Returns the name of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $name = $bdt->get_name();
     *
     * // $name will contain 'Bangladeshi Taka'
     * ```
     * @return string The name of the currency.
     */
    public function get_name(): string;

    /**
     * Returns the ISO code of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $iso = $bdt->get_iso();
     *
     * // $iso will contain 'BDT'
     * ```
     * @return string The ISO code of the currency.
     */
    public function get_iso(): string;

    /**
     * Returns the symbol of the currency.
     *
     * ```php
     * <?php
     * $bdt = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
     * $symbol = $bdt->get_symbol();
     *
     * // $symbol will contain '৳'
     * ```
     * @return string The symbol of the currency.
     */
    public function get_symbol(): string;

}