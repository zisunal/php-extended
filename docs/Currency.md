[⬅️Back to Instructions List](../readme.md)
---
## `Currency`
## Chainable Methods
`add_transaction` is a chainable method. That means you can use any other method with that directly like this:
```php
$taka->add_transaction(1500)->add_transaction(500, false);
```
## Non-Chainable Methods
All the methods except `add_transaction` are non-chainable methods. Example: You can't use any other method after `convert_to`. It will return int or float (the equivalent amount of the other `Currency`)
```php
$taka->add_transaction(1500)->add_transaction(500, false)->convert_to($pound, $taka->balance());
```
---

## 🧩 Methods Available
- Remember that it is ✅`Currency` ✅
  
|    Method   | Description                         | Arguments       | Return Type      |
|-------------|-------------------------------------|-----------------|------------------|
|new Currency()| Create a new `Currency` instance    | string $name, string $iso, string $symbol, float $exchange_rate | Currency |
|   get_meta  | Get metadata about the currency     |         X       |   array          |
| add_transaction | Add a transaction to the currency | int \| float $amount, bool $credit (optional \| Default: true) | Currency |
|get_transactions| Get all transactions for the currency|         X       |   array          |
|get_transaction | Get a specific transaction by its ID| string $id       |   array \| null  |
|convert_to      | Convert the currency to another currency| Currency $to, float $amount |  int \| float|
| convert_histories | Get the conversion histories of the currency | X | array |
| credit_sum | Get the total credit amount of the currency | X | int \| float \| null |
| debit_sum | Get the total debit amount of the currency | X | int \| float \| null |
| balance | Get the current balance of the currency | X | int \| float \| null |
| get_name | Get the name of the currency | X | string |
| get_iso | Get the ISO code of the currency | X | string |
| get_symbol | Get the symbol of the currency | X | string |
