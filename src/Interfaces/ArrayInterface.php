<?php

namespace Zisunal\PhpExtended\Interfaces;

use Zisunal\PhpExtended\Enums\Separator;
use Zisunal\PhpExtended\Enums\SortRule;
use Zisunal\PhpExtended\Enums\PopulatePattern;
use Zisunal\PhpExtended\_Array;

interface ArrayInterface
{
    /**
     * _Array constructor.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->all();
     * ```
     * @param array|_Array $items
     */
    public function __construct(array|_Array $items = []);
    /**
     * Get all elements from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, 4, 5]);
     * $array->all();
     *
     * // Will return [1, 2, 3, 4, 5]
     * ```
     * ?>
     * @return array
     */
    public function all(): array;
    /**
     * Get a specific element from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, "foo" => "bar", 4, 5]);
     * $array->get(0);
     * // Will return 1
     *
     * $array->get("foo");
     * // Will return "bar"
     * ```
     * ?>
     * @param int | string $key
     * @return mixed
     */
    public function get(int | string $key): mixed;
    /**
     * Add a specific element to the array at the end.
     * This won't update existing elements. To update use `$array->update()` method instead.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->add(3, 4);
     * // Will add 4 at 3rd index
     *
     * $array->add("foo", "bar");
     * // Will add "bar" at key "foo"
     *
     * // The final array will be [1, 2, 3, 4, "foo" => "bar"]
     * ```
     * ?>
     * @param int | string $key
     * @param mixed $value
     * @return self
     */
    public function add(int | string $key, mixed $value): self;
    /**
     * Get the first element from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->first();
     * // Will return 1
     * ```
     * ?>
     * @return mixed
     */
    public function first(): mixed;
    /**
     * Get the last element from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->last();
     * // Will return 3
     * ```
     * ?>
     * @return mixed
     */
    public function last(): mixed;
    /**
     * Get the count of elements in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->count();
     * // Will return 3
     * ```
     * ?>
     * @return int
     */
    public function count(): int;
    /**
     * Remove a specific element from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->remove(1);
     * // Will remove 2 from the first index
     * $array->remove("foo");
     * // Will remove "bar" from the key "foo"
     * ```
     * ?>
     * @param int | string $key
     * @return self
     */
    public function remove(int | string $key): self;
    /**
     * Add a specific element to the start of the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->prepend(null, 0);
     * $array->prepend("foo", "bar");
     *
     * // The final array will be ["foo" => "bar", 0, 1, 2, 3]
     * ```
     * ?>
     * @param int | string $key
     * @param mixed $value
     * @return self
     */
    public function prepend(int | string $key = null, mixed $value): self;
    /**
     * Add a specific element to the array at a specific position.
     * This won't update existing elements. To update use `$array->update()` method instead.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->addAt(1, null, 1.5);
     * $array->addAt(2, "foo", "bar");
     *
     * // The final array will be [1, 1.5, 2, "foo" => "bar", 3]
     * ```
     * ?>
     * @param int $position
     * @param int | string $key
     * @param mixed $value
     * @return self
     */
    public function addAt(int $position, int | string $key = null, mixed $value): self;
    /**
     * Update a specific element in the array.
     * This won't add the element if it doesn't exist. To add it, use the `add` or `addAt` method.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->update(1, 2.5);
     * // Will update the value at index 1 to 2.5
     *
     * $array->update("foo", "baz");
     * // Will update the value at key "foo" to "baz"
     * // The final array will be [1, 2.5, 3, "foo" => "baz"]
     * ```
     * ?>
     * @param int | string $key
     * @param mixed $value
     * @return self
     */
    public function update(int | string $key, mixed $value): self;
    /**
     * Check if a specific value exists in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->has(1);
     * // Will return true
     *
     * $array->has("foo");
     * // Will return true
     *
     * $array->has(4);
     * // Will return false
     * ```
     * ?>
     * @param int | string $value
     * @return bool
     */
    public function has(int | string $value): bool;
    /**
     * Check if a specific key exists in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->hasKey(1);
     * // Will return true
     *
     * $array->hasKey("foo");
     * // Will return true
     *
     * $array->hasKey(4);
     * // Will return false
     * ```
     * ?>
     * @param int | string $key
     * @return bool
     */
    public function hasKey(int | string $key): bool;
    /**
     * Check if any of the specified values exist in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->hasAny(1, 4);
     * // Will return true
     *
     * $array->hasAny("foo", "baz");
     * // Will return true
     *
     * $array->hasAny(4, 5);
     * // Will return false
     * ```
     * ?>
     * @param int | string ...$value
     * @return bool
     */
    public function hasAny(int | string ...$value): bool;
    /**
     * Check if any of the specified keys exist in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->hasAnyKey(1, 4);
     * // Will return true
     *
     * $array->hasAnyKey("foo", "baz");
     * // Will return true
     *
     * $array->hasAnyKey(4, 5);
     * // Will return false
     * ```
     * ?>
     * @param int | string ...$key
     * @return bool
     */
    public function hasAnyKey(int | string ...$key): bool;
    /**
     * Check if all of the specified values exist in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->hasAll(1, 2);
     * // Will return true
     *
     * $array->hasAll("foo", "baz");
     * // Will return false
     * ```
     * ?>
     * @param int | string ...$value
     * @return bool
     */
    public function hasAll(int | string ...$value): bool;
    /**
     * Check if all of the specified keys exist in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, "foo" => "bar"]);
     * $array->hasAllKeys(1, 2);
     * // Will return true
     *
     * $array->hasAllKeys("foo", "baz");
     * // Will return false
     * ```
     * ?>
     * @param int | string ...$key
     * @return bool
     */
    public function hasAllKeys(int | string ...$key): bool;
    /**
     * Apply a callback function to each element in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $result = $array->map(fn($item) => $item * 2);
     * // Will return [2, 4, 6]
     * // You can also use $array->getAll() anywhere to get the final array
     * ```
     * ?>
     * @param callable $callback
     * @return self
     */
    public function map(callable $callback): self;
    /**
     * Filter the array using a callback function.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $result = $array->filter(fn($item) => $item > 1);
     * // Will return [2, 3]
     * // You can also use $array->getAll() anywhere to get the final array
     * ```
     * ?>
     * @param callable $callback
     * @return self
     */
    public function filter(callable $callback): self;
    /**
     * Iterate over each element in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->foreach(fn($item) => print($item));
     * // Will print 1 2 3
     * ```
     * ?>
     * @param callable $callback
     * @return void
     */
    public function foreach(callable $callback): void;
    /**
     * Clear the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->clear();
     * // Will remove all elements from the array
     * ```
     * ?>
     * @return self
     */
    public function clear(): self;
    /**
     * Convert the array to a string.
     *
     * ```php
     * <?php
     * use Zisunal\PhpArrayExtended\Enums\Separator;
     * $array = new _Array([1, 2, 3]);
     * $array->toString(Separator::TAKA, true);
     * // Will return "1৳, 2৳, 3৳"
     * ```
     * ?>
     * @param Separator $separator
     * Separators available:
     * - `Separator::COMMA` (default)
     * - `Separator::SEMICOLON`
     * - `Separator::SPACE`
     * - `Separator::TAB`
     * - `Separator::NEWLINE`
     * - `Separator::CARRIAGE_RETURN`
     * - `Separator::COLON`
     * - `Separator::PIPE`
     * - `Separator::DOUBLE_QUOTE`
     * - `Separator::SINGLE_QUOTE`
     * - `Separator::BACKTICK`
     * - `Separator::HASH`
     * - `Separator::AMPERSAND`
     * - `Separator::PERCENT`
     * - `Separator::EXCLAMATION`
     * - `Separator::TILDE`
     * - `Separator::QUESTION`
     * - `Separator::NULL_BYTE`
     * - `Separator::FORWARD_SLASH`
     * - `Separator::BACKWARD_SLASH`
     * - `Separator::AT`
     * - `Separator::DOLLAR`
     * - `Separator::CARET`
     * - `Separator::TAKA`
     * - `Separator::EURO`
     * - `Separator::POUND`
     * - `Separator::YEN`
     * - `Separator::PAKISTANI_RUPEE`
     * - `Separator::INDIAN_RUPEE`
     * - `Separator::NEPALESE_RUPEE`
     * - `Separator::SRI_LANKAN_RUPEE`
     * - `Separator::BHUTANESE_NGULTRUM`
     * - `Separator::MYANMAR_KYAT`
     * - `Separator::LAO_KIP`
     * - `Separator::PLUS`
     * - `Separator::MINUS`
     * - `Separator::ASTERISK`
     * - `Separator::EQUALS`
     * @param bool $addSpace
     * To add a space after the separator.
     * @return string
     */
    public function toString(Separator $separator = Separator::COMMA, bool $addSpace = false): string;
    /**
     * Shuffle the elements in the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $array->shuffle();
     * // Will randomize the order of elements in the array
     * ```
     * ?>
     * @return self
     */
    public function shuffle(): self;
    /**
     * Concatenate the array with another one or multiple array/s.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $result = $array->concat([4, 5]);
     * // Will return [1, 2, 3, 4, 5]
     * $result = $array->concat([6, 7], [8, 9]);
     * // Will return [1, 2, 3, 6, 7, 8, 9]
     * ```
     * ?>
     * @param array ...$array
     * @return self
     */
    public function concat(array ...$array): self;
    /**
     * Splice the array, removing elements and optionally replacing them.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, 4, 5]);
     * $result = $array->splice(1, 2, [6, 7]);
     * // $result will return [2, 3] 
     * // $array->getAll() will return [1, 6, 7, 4, 5]
     * ```
     * ?>
     * @param int $offset
     * @param int $length
     * @param array $replacement
     * @return self
     */
    public function splice(int $offset, int $length = 0, array $replacement = []): self;
    /**
     * Get the array as a JSON string.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $json = $array->toJson();
     * // Will return '[1,2,3]'
     * ```
     * ?>
     * @return string
     */
    public function toJson(): string;
    /**
     * Get the array as a PHP array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $phpArray = $array->toArray();
     * // Will return [1, 2, 3]
     * ```
     * ?>
     * @return array
     */
    public function toArray(): array;
    /**
     * Get the array as a PHP object.
     *
     * ```php
     * <?php
     * $array = new _Array([
     *      "foo" => "bar",
     *      "baz" => "qux"
     * ]);
     * $object = $array->toObject();
     * // Will return an object with properties foo and baz and values bar and qux
     * ```
     * ?>
     * @return object
     */
    public function toObject(): object;
    /**
     * Sort the array by values or keys in ascending or descending order.
     *
     * ```php
     * <?php
     * use Zisunal\PhpArray\Enums\SortRule;
     * $array = new _Array([3, 1, 2]);
     * $sorted = $array->sort(SortRule::ASCENDING);
     * // Will return [1, 2, 3]
     * ```
     * ?>
     * @param SortRule $rule | Can be SortRule::ASCENDING, SortRule::DESCENDING, SortRule::KEY_ASCENDING, SortRule::KEY_DESCENDING | Default: SortRule::ASCENDING
     * @return self
     */
    public function sort(SortRule $rule = SortRule::ASCENDING): self;
    /**
     * Reduce the array to a single value.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $result = $array->reduce(fn($acc, $item) => $acc + $item, 0);
     * // Will return 6
     * ```
     * ?>
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, mixed $initial = null): mixed;
    /**
     * Reverse the order of the array.
     *
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $reversed = $array->reverse();
     * // Will return [3, 2, 1]
     * ```
     * ?>
     * @return self
     */
    public function reverse(): self;
    /**
     * Get a random element from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $random = $array->random();
     * // Will return a random element from the array
     * ```
     * ?>
     * @return mixed
     */
    public function random(): mixed;
    /**
     * Populate the array with values based on the given pattern.
     *
     * ```php
     * <?php
     * $array = new _Array();
     * $result = $array->populate(PopulatePattern::SEQUENTIAL_INTEGER);
     * // Will return [1, 2, 3, ...]
     * ```
     * ?>
     * @param int $count
     * How many items to generate. Default is 10.
     * @param PopulatePattern $pattern
     * Patterns available:
     * - PopulatePattern::SEQUENTIAL_INTEGER
     * - PopulatePattern::SEQUENTIAL_STRING
     * - PopulatePattern::SEQUENTIAL_FLOAT
     * - PopulatePattern::RANDOM_STRING
     * - PopulatePattern::RANDOM_INTEGER
     * - PopulatePattern::RANDOM_FLOAT
     * - PopulatePattern::RANDOM
     * @return self
     */
    public function populate(int $count = 10, PopulatePattern $pattern = PopulatePattern::SEQUENTIAL_INTEGER): self;
    /**
     * Get the sum of the array's int/float type values.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $sum = $array->sum();
     * // Will return 6
     * ```
     * ?>
     * @return float|int
     */
    public function sum(): float|int;
    /**
     * Get the minimum int/float type value from the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $min = $array->min();
     * // Will return 1
     * ```
     * ?>
     * @return float|int
     */
    public function min(): float|int;
    /**
     * Get the maximum int/float type value of the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $max = $array->max();
     * // Will return 3
     * ```
     * ?>
     * @return float|int
     */
    public function max(): float|int;
    /**
     * Get the median of int/float type value of the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3]);
     * $median = $array->median();
     * // Will return 2
     * ```
     * ?>
     * @return float|int
     */
    public function median(): float|int;
    /**
     * Get the mode of int/float value of the array.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 2, 3]);
     * $mode = $array->mode();
     * // Will return 2
     * ```
     * ?>
     * @return float|int
     */
    public function mode(): float|int;
    /**
     * Partition the array into smaller chunks to process them individually.
     *
     * ```php
     * <?php
     * $array = new _Array([1, 2, 3, 4, 5]);
     * $partitions = $array->partition(fn($chunk) => array_sum($chunk), 2);
     * // Will return [3, 7]
     * ```
     * ?>
     * @param callable $callback
     * @param int $partition_count
     * How many parts will be created. Default is 2.
     * @return self
     */
    public function partition(callable $callback, int $partition_count = 2): self;
}