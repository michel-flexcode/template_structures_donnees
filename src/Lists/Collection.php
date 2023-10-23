<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class Collection extends ArrayList implements CollectionInterface
{
    public function map(callable $callback): CollectionInterface
    {
        $collection = new Collection();

        foreach ($this->toArray() as $key => $value) {
            $collection->push($callback($value, $key));
        }

        return $collection;
    }

    public function filter(callable $callback): CollectionInterface
    {
        //Stock est de classe collection 
        $Stock = new Collection();

        foreach ($this->toArray() as $key => $value) {
            if ($callback($value, $key)) { // Use the callback to determine if the value should be included
                $Stock->push($value);
            }
        }

        return $Stock;
    }

    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        $carry = $initial;

        foreach ($this->toArray() as $key => $value) {
            //$key utile si besoin d'un affichage spécifique, facultatif
            $carry = $callback($carry, $value, $key);
        }

        return $carry;
    }

    public function forEach(callable $callback): void
    {
        $summ = 0;

        foreach ($this->toArray() as $key => $value) {
            //$key utile si besoin d'un affichage spécifique, facultatif
            $summ = $callback($value);
        }
    }

    public function some(callable $callback): bool
    {
        foreach ($this->toArray() as $key => $value) {
            if ($callback($value, $key)) {
                return true; // Retourne true dès qu'un élément satisfait la condition.
            }
        }

        return false; // Si aucun élément ne satisfait la condition, retourne false.
    }

    public function every(callable $callback): bool
    {
        foreach ($this->toArray() as $key => $value) {
            if ($callback($value, $key)) {
                return true; // Retourne true dès qu'un élément satisfait la condition.
            }
        }

        return false; // Si aucun élément ne satisfait la condition, retourne false.
    }

    public function find(callable $callback): mixed
    {
        foreach ($this->toArray() as $key => $value) {
            if ($callback($value, $key)) {
                return $value; // Renvoie la première correspondance trouvée
            }
        }

        return null; // Renvoie null si aucune correspondance n'a été trouvée
    }

    public function findIndex(callable $callback): int
    {
    }

    public function join(string $separator = ', '): string
    {
    }

    public function reverse(): CollectionInterface
    {
        $collection = new Collection();

        $array = $this->toArray();
        $reversedArray = array_reverse($array);

        foreach ($reversedArray as $value) {
            $collection->push($value);
        }

        return $collection;
    }

    public function sort(callable $callback = null): CollectionInterface
    {
    }

    public function concat(...$collections): CollectionInterface
    {
    }

    public function fill(mixed $value = null, int $start = 0, ?int $end = null): CollectionInterface
    {
    }
}
