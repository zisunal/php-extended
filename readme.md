# Zisunal PHP Array Extended

A modern, flexible PHP array utility library.  
Implements the [`ArrayInterface`](./src/Interfaces/ArrayInterface.php).

---

## ✨ Features

- Consistent, object-oriented array manipulation
- Type-safe methods
- Extensible interface for custom array utilities

---

## 🚀 Quick Start

```bash
composer require zisunal/php-extended
```

```php
use Zisunal\PhpExtended\_Array;

$array = new _Array([1, 2, 3]);
$array->add(4);
print_r($array->all());
```

---

## You can also use most of the required methods as chain. Example:

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
### Chainable Methods
All the methods with return type `_Array` are chainable methods. That means if any method returns `_Array` as per the below table, you can use other methods with that directly like this:
```php
$array->populate(15)->shuffle()->reverse();
```

### Non-Chainable Methods
All the methods with return type other than `_Array` are non-chainable methods. That means if any method returns anything but `_Array` as per the below table, you can't use other methods after that. In this example `random()` is a non-chainable method. So, you can't add any more method after this:
```php
$array->populate(15)->shuffle()->reverse()->random();
```
---

## 🧩 Methods Available
### `String` and `Number` are under construction

### `_Array`
- Remember that it is not `Array`❌, it is `_Array` ✅
  
|    Method   | Description                         | Arguments       | Return Type      |
|-------------|-------------------------------------|-----------------|------------------|
|    all      | Get all the elements as PHP array   |        X        |        X         |
|    get      |Get a specific element from the array|int\|string $key |      mixed       |
|    add      | Add a specific element to the array at the end. This won't update existing elements. To update use `update` method instead. |int\|string $key, mixed $value|      _Array      |
|   first     |Get the first element from the array |        X        |       mixed      |
|   last      | Get the last element from the array |        X        |       mixed      |
|  count      |Get the count of elements in the array|        X       |       int        |
|  remove     |Remove a specific element from the array|int\|string $key|    _Array      |
|  prepend    |Add a specific element to the start of the array|int\|string $key (optional), mixed $value|_Array        |
|  addAt      |Add a specific element to the array at a specific position. This won't update existing elements. To update use `update` method instead|int $position,int\|string $key (optional), mixed $value|_Array|
|  update     |Update a specific element in the array. This won't add the element if it doesn't exist. To add it, use the `add` or `addAt` method|int\|string $key, mixed $value| _Array |
|     has     |Check if a specific value exists in the array|int\|string $value |  bool  |
|    hasKey   | Check if a specific key exists in the array |int\|string $key   |  bool  |
|    hasAny   |Check if any of the specified values exist in the array|(int\|string) $value1, $value2, $value3, ...|bool|
|  hasAnyKey  |Check if any of the specified keys exist in the array|(int\|string) $key1, $key2, $key3, ...|bool|
|    hasAll   |Check if all of the specified values exist in the array|(int\|string) $value1, $value2, $value3, ...|bool|
|  hasAllKey  |Check if all of the specified keys exist in the array|(int\|string) $key1, $key2, $key3, ...|bool|
|    map      |Apply a callback function to each element in the array|callable $callback|_Array|
|   filter    |Filter the array using a callback function|callable $callback|   _Array  |
|   foreach   |Iterate over each element in the array| callable $callback |     void    |
|    clear    |Clear the array                       |         X          |    _Array   |
|   toString  |Convert the array to a string         |Separator $separator (optional) [`See Available Separators List`](./separators.md), bool $addSpace (optional)|     string|
|   shuffle   |Shuffle the elements in the array     |          X         |    _Array   |
|    concat   |Concatenate the array with another one or multiple array/s|(array) $array1, $array2, $array3, ...|_Array|
|    splice   |Splice the array, removing elements and optionally replacing them|int $offset, int $length (optional), array $replacement (optional)|_Array|
|    toJson   |Get the `_Array` as a `JSON string`   |          X         |    string   |
|   toArray   |Get the `_Array` as a `PHP array`     |          X         |     array   |
|   toObject  |Get the `_Array` as a `PHP StdObject` |          X         |    object   |
|     sort    |Sort the array by values or keys in ascending or descending order|SortRule $rule [`See Available Sort Rules`](./sort-rules.md)|_Array|
|    reduce   |Reduce the array to a single value    |callable $callback, mixed $initial (optional)|mixed|
|   reverse   |Reverse the order of the array        |          X         |    _Array   |
|    random   |Get a random element from the array   |          X         |    mixed    |
|   populate  |Populate the array with values based on the given pattern|int $count, PopulatePattern $pattern (optional) [`See Available Populate Patterns`](./populate-patterns.md)|    _Array   |
|     sum     |Get the sum of the array's int/float type values|     X    |  float|int  |
|     min     |Get the minimum int/float type value from the array|   X   |  float|int  |
|     max     |Get the maximum int/float type value of the array|    X    |  float|int  |
|    median   |Get the median of int/float type value of the array|   X   |  float|int  |
|     mode    |Get the mode of int/float type value of the array|    X    |  float|int  |
|  partition  |Partition the array into smaller chunks to process them individually|callable $callback, int $partition_count (optional, default = 2)|_Array|

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