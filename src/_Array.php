<?php

namespace Zisunal\PhpExtended;

use Zisunal\PhpExtended\Interfaces\ArrayInterface;
use Zisunal\PhpExtended\Enums\PopulatePattern;
use Zisunal\PhpExtended\Enums\Separator;
use Zisunal\PhpExtended\Enums\SortRule;

class _Array implements ArrayInterface
{
    private $items = [];

    public function __construct(array|_Array $items = [])
    {
        $this->items = $this->get_arrayable_items($items);
    }

    private function get_arrayable_items(mixed $args): array
    {
        return is_array($args) ? $args : (is_object($args) ? (is_a($args, _Array::class) ? $args->all() : [$args]) : [$args]);
    }
    public function all(): array
    {
        return $this->items;
    }
    public function get(int | string $key): mixed
    {
        return $this->items[$key] ?? null;
    }
    public function toJson(): string
    {
        return json_encode($this->items);
    }
    public function toArray(): array
    {
        return $this->items;
    }
    public function toObject(): object
    {
        return (object) $this->items;
    }
    public function sort(SortRule $rule = SortRule::ASCENDING): self
    {
        switch ($rule) {
            case SortRule::ASCENDING:
                asort($this->items);
                break;
            case SortRule::DESCENDING:
                arsort($this->items);
                break;
            case SortRule::KEY_ASCENDING:
                ksort($this->items);
                break;
            case SortRule::KEY_DESCENDING:
                krsort($this->items);
                break;
        }
        return $this;
    }
    public function reverse(): self
    {
        return new _Array(array_reverse($this->items));
    }
    public function random(): mixed
    {
        return $this->items[array_rand($this->items)] ?? null;
    }
    public function populate(int $count = 10, PopulatePattern $pattern = PopulatePattern::SEQUENTIAL_INTEGER): self
    {
        $strings = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $this->items = match ($pattern) {
            PopulatePattern::SEQUENTIAL_INTEGER => range(1, $count),
            PopulatePattern::SEQUENTIAL_STRING => array_map(fn($i) => $strings[$i % strlen($strings)], range(0, $count - 1)),
            PopulatePattern::SEQUENTIAL_FLOAT => array_map(fn($i) => (float) $i, range(1, $count)),
            PopulatePattern::RANDOM_INTEGER => array_map(fn() => rand(1, 100), range(1, $count)),
            PopulatePattern::RANDOM_STRING => array_map(fn() => bin2hex(random_bytes(5)), range(1, $count)),
            PopulatePattern::RANDOM_FLOAT => array_map(fn() => (float) rand(), range(1, $count)),
            PopulatePattern::RANDOM => array_map(fn() => bin2hex(random_bytes(5)), range(1, $count)),
        };
        return $this;
    }
    public function sum(): float|int
    {
        return array_reduce($this->items, fn($carry, $item) => $carry + (is_numeric($item) ? $item : 0), 0);
    }
    public function min(): float|int
    {
        return array_reduce($this->items, fn($carry, $item) => $carry === null ? $item : (is_numeric($item) ? min($carry, $item) : $carry), null);
    }
    public function max(): float|int
    {
        return array_reduce($this->items, fn($carry, $item) => $carry === null ? $item : (is_numeric($item) ? max($carry, $item) : $carry), null);
    }
    public function median(): float|int
    {
        $numbers = array_filter($this->items, 'is_numeric');
        if (empty($numbers)) {
            return 0;
        }
        sort($numbers);
        $count = count($numbers);
        return $count % 2 === 1 ? $numbers[$count / 2] : ($numbers[$count / 2 - 1] + $numbers[$count / 2]) / 2;
    }
    public function mode(): float|int
    {
        $values = array_filter($this->items, 'is_numeric');
        if (empty($values)) {
            return 0;
        }
        $frequency = array_count_values($values);
        $maxFreq = max($frequency);
        $modes = array_keys($frequency, $maxFreq);
        return count($modes) === 1 ? $modes[0] : $modes;
    }
    public function add(int | string $key, mixed $value): self
    {
        if (!isset($this->items[$key])) {
            $this->items[$key] = $value;
        }
        return $this;
    }
    public function first(): mixed
    {
        return $this->items[array_key_first($this->items)] ?? null;
    }
    public function last(): mixed
    {
        return $this->items[array_key_last($this->items)] ?? null;
    }
    public function count(): int
    {
        return count($this->items);
    }
    public function remove(int | string $key): self
    {
        unset($this->items[$key]);
        return $this;
    }
    public function prepend(int | string $key = null, mixed $value): self
    {
        if ($key !== null) {
            $this->items = [$key => $value] + $this->items;
        } else {
            array_unshift($this->items, $value);
        }
        return $this;
    }
    public function addAt(int $position, int | string $key = null, mixed $value): self
    {
        if ($key !== null) {
            $this->items = array_slice($this->items, 0, $position, true) + [$key => $value] + array_slice($this->items, $position, null, true);
        } else {
            array_splice($this->items, $position, 0, $value);
        }
        return $this;
    }
    public function update(int | string $key, mixed $value): self
    {
        if (isset($this->items[$key])) {
            $this->items[$key] = $value;
        }
        return $this;
    }
    public function has(int | string $value): bool
    {
        return in_array($value, $this->items, true);
    }
    public function hasKey(int | string $key): bool
    {
        return array_key_exists($key, $this->items);
    }
    public function hasAny(int | string ...$value): bool
    {
        foreach ($value as $v) {
            if ($this->has($v)) {
                return true;
            }
        }
        return false;
    }
    public function hasAnyKey(int | string ...$key): bool
    {
        foreach ($key as $k) {
            if ($this->hasKey($k)) {
                return true;
            }
        }
        return false;
    }
    public function hasAll(int | string ...$value): bool
    {
        foreach ($value as $v) {
            if (!$this->has($v)) {
                return false;
            }
        }
        return true;
    }
    public function hasAllKeys(int | string ...$key): bool
    {
        foreach ($key as $k) {
            if (!$this->hasKey($k)) {
                return false;
            }
        }
        return true;
    }
    public function partition(callable $callback, int $partition_count = 2): self
    {
        $partitions = [];
        foreach ($this->items as $item) {
            $key = $callback($item);
            if (!isset($partitions[$key])) {
                $partitions[$key] = [];
            }
            $partitions[$key][] = $item;
        }
        return new _Array(array_slice($partitions, 0, $partition_count));
    }
    public function map(callable $callback): self
    {
        $this->items = array_map($callback, $this->items);
        return $this;
    }
    public function filter(callable $callback): self
    {
        $this->items = array_filter($this->items, $callback);
        return $this;
    }
    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        return array_reduce($this->items, $callback, $initial);
    }
    public function foreach(callable $callback): void
    {
        foreach ($this->items as $key => $value) {
            $callback($value, $key);
        }
    }
    public function clear(): self
    {
        $this->items = [];
        return $this;
    }
    public function toString(Separator $separator = Separator::COMMA, bool $addSpace = false): string
    {
        $glue = $addSpace ? " {$separator->value} " : $separator->value;
        return implode($glue, $this->items);
    }
    public function shuffle(): self
    {
        shuffle($this->items);
        return $this;
    }
    public function concat(array|_Array ...$array): self
    {
        foreach ($array as $arr) {
            if (is_array($arr)) {
                $this->items = array_merge($this->items, $arr);
            } elseif (is_a($arr, _Array::class)) {
                $this->items = array_merge($this->items, $arr->all());
            }
        }
        return $this;
    }
    public function splice(int $offset, int $length = 0, array $replacement = []): self
    {
        $removed = array_splice($this->items, $offset, $length, $replacement);
        return $this;
    }
}