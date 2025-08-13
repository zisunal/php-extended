# Zisunal PHP Extended

A modern, flexible PHP utility library.  
1. `_Array` Implements the [`ArrayInterface`](./src/Interfaces/ArrayInterface.php).
2. `Currency` Implements the [`CurrencyInterface`](./src/Interfaces/CurrencyInterface.php).
3. `String` is under construction
4. `Number` is under construction

---

## ✨ Features

- Consistent, object-oriented array, currency, string and number manipulation
- Type-safe methods
- Extensible interface for custom utilities

---

## 🚀 Quick Start

```bash
composer require zisunal/php-extended
```
#### To use the `_Array` type:
```php
use Zisunal\PhpExtended\_Array;

$array = new _Array([1, 2, 3]);
$array->add(4)->add(5)->remove(3)->concat(new _Array()->populate(15)->all())->shuffle();
print_r($array->all());
echo $array->random();
echo $array->toString();
echo $array->toJson();
```
#### To use the `Currency` type:
```php
use Zisunal\PhpExtended\Currency;

$taka = new Currency('Bangladeshi Taka', 'BDT', '৳', 0.008);
$pound = new Currency('Pound Sterling', 'GBP', '£', 1.35);
$taka->add_transaction(1500)->add_transaction(500, false)->convert_to($pound, $taka->balance());
```

## You can use most of the required methods as chain. Example:

```php
$array = new _Array();
$array->populate(15)->shuffle()->reverse()->random();
```
### The above code will do 4 operations to an empty array:
1. Populate the array with digits from 1 to 15
2. Randomize the array values
3. Reverse the randomized array
4. Take a random value from the reversed randomized array

## 📚 Documentation
### `String` and `Number` are under construction
- [Documentation for `_Array`](./docs/_Array.md)
- [Documentation for `Currency`](./docs/Currency.md)

---

## 🛠️ Contributing
### Contribution always makes the life easier and the earth happier. To contribute, please follow:
1. Fork the repository
2. Add/Update features
3. Test all of your codes
4. Create a feature branch
5. Submit a pull request

---

## 📄 License

MIT. See the license details here: [License](./license.md)

---