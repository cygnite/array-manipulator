<?php
namespace Cygnite\Common\ArrayManipulator;

class ArrayAccessor implements ArrayAccessorInterface
{
    protected $arrayStack = [];

    protected $replaceWith = '_REPLACEMENT_';

    protected $identifierArray = ['_', '-'];

    protected $defaultIdentifier = '.';

    /**
     * @param array $array
     * @return $this
     */
    public function set(array $array)
    {
        $this->arrayStack = $array;

        return $this;
    }
    /**
     * @param string $string
     * @return array
     */
    protected function getKeysFromString($string)
    {
        $string = str_replace($this->identifierArray, $this->replaceWith, $string);
        $parts = explode($this->defaultIdentifier, $string);

        return array_map(function ($part)
        {
            return str_replace($this->replaceWith, $this->defaultIdentifier, $part);
        }, $parts);
    }

    /**
     * We will manipulate the string to get each array index
     * and find array value
     *
     * @param string $string
     * @return mixed
     */
    protected function manipulate($string)
    {
        $chunks = $this->getKeysFromString($string);
        $array = $this->getArray();

        return $this->formatArray($array, $chunks);
    }

    /**
     * Check Array key Existence
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $array = $this->getArray();

        return (isset($array[$key])) ? true : false;
    }

    private function formatArray($array, $chunks)
    {
        /*
         | Loop all array index to find the array value
         */
        foreach($chunks as $index) {

            if (!isset($array[$index])) {
                return null;
            }

            $array = $array[$index];
        }

        return $array;
    }

    /**
     * Return array
     *
     * @return array
     */
    public function getArray()
    {
        return $this->arrayStack;
    }

    /**
     * We will convert array to json objects
     * @return string
     */
    public function asJson()
    {
        return json_encode($this->getArray());
    }

    /**
     * We will check if $key is string or integer
     * return value accordingly
     *
     * @param        $key
     * @param string $default
     * @return int|string
     */
    public function getValue($key, $default = '')
    {
        $value = $this->manipulate($key);

        switch ($key) {
            case is_string($key) :
                return $this->getStringValue($value, $default);
                break;
            case is_int($key) :
                return $this->getNumericValue($value, $default);
                break;
        }
    }

    /**
     * Get string array index value
     *
     * @param $value
     * @param $default
     * @return string
     */
    protected function getStringValue($value, $default)
    {
        /*
         | If we don't find array index we will return default value
         */
        if (is_null($value)) {
            return strval($default);
        }

        return strval($value);
    }

    /**
     * Get numeric array index value
     *
     * @param $value
     * @param $default
     * @return int
     */
    protected function getNumericValue($value, $default)
    {
        if (is_null($value)) {
            return intval($default);
        }

        return intval($value);
    }
}