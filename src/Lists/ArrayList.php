<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    public function push(mixed $element = null): void
    {
        if (!empty($this->elements) && gettype($element) !== gettype($this->elements[0])) {
            throw new \InvalidArgumentException("Element type does not match the type of the existing elements");
        }

        $this->elements[] = $element;
    }

    public function get(int $index): mixed
    {
        if (!isset($this->elements[$index])) {
            throw new \OutOfBoundsException("Index $index is out of bounds.");
        }
        return $this->elements[$index];
    }

    public function set(int $index, mixed $element): void
    {
        if (!isset($this->elements[$index])) {
            throw new \InvalidArgumentException("it should throw exception when set index not found ( or maybe doesn't exist )");
        }
        $this->elements[$index] = $element;
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function includes(mixed $element): bool
    {
        foreach ($this->elements as $value) {
            if ($value === $element) {
                return true;
            }
        }

        return false;
    }

    public function isEmpty(): bool
    {
        //return (count($this->elements) > 1);
        //BURN IN HELL TO USE THAT FUNCTION alternative native php

        if (empty($this->elements)) {
            return true;
        } else {
            return false;
        }


        // if (count($this->elements) > 1) {
        //     return true;
        // } else {
        //     return false;
        // };
    }

    public function indexOf(mixed $element): int
    {
        foreach ($this->elements as $key => $value) {
            if ($value === $element) {
                return $key;
            }
        }

        throw new \InvalidArgumentException("Element not found in the array");
    }

    public function remove(int $index): void
    {
        if (!isset($this->elements[$index])) {
            throw new \InvalidArgumentException("it should throw exception when set index not found ( or maybe doesn't exist )");
        }
        unset($this->elements[$index]);
        $this->elements = array_values($this->elements);
    }

    public function size(): int
    {
        return count($this->elements);
    }

    public function toArray(): array
    {
        if (is_array($this->elements)) {
            // If $this->elements is already an array, simply return it
            return $this->elements;
        } elseif (is_object($this->elements) && method_exists($this->elements, 'toArray')) {
            // If $this->elements is an object with a 'toArray' method, call that method
            return $this->elements->toArray();
        } else {
            // Handle other cases as needed, or return an empty array if it's not convertible
            return [];
        }
    }
}
