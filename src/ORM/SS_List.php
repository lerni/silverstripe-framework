<?php

namespace SilverStripe\ORM;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * An interface that a class can implement to be treated as a list container.
 *
 * @template T
 * @extends ArrayAccess<array-key, T>
 * @extends IteratorAggregate<array-key, T>
 *
 * @deprecated 5.4.0 Will be renamed to SilverStripe\Model\List\SS_List
 */
interface SS_List extends ArrayAccess, Countable, IteratorAggregate
{

    /**
     * Returns all the items in the list in an array.
     *
     * @return array<T>
     */
    public function toArray();

    /**
     * Returns the contents of the list as an array of maps.
     *
     * @return array
     */
    public function toNestedArray();

    /**
     * Adds an item to the list, making no guarantees about where it will
     * appear.
     *
     * @param mixed $item
     */
    public function add($item);

    /**
     * Removes an item from the list.
     *
     * @param mixed $item
     */
    public function remove($item);

    /**
     * Returns the first item in the list.
     *
     * @return T|null
     */
    public function first();

    /**
     * Returns the last item in the list.
     *
     * @return T|null
     */
    public function last();

    /**
     * Returns a map of a key field to a value field of all the items in the
     * list.
     *
     * @param  string $keyfield
     * @param  string $titlefield
     * @return Map
     */
    public function map($keyfield = 'ID', $titlefield = 'Title');

    /**
     * Returns the first item in the list where the key field is equal to the
     * value.
     *
     * @param  string $key
     * @param  mixed $value
     * @return T|null
     */
    public function find($key, $value);

    /**
     * Returns an array of a single field value for all items in the list.
     *
     * @param  string $colName
     * @return array
     */
    public function column($colName = "ID");

    /**
     * Walks the list using the specified callback
     *
     * @param callable $callback
     * @return static<T>
     */
    public function each($callback);
}
