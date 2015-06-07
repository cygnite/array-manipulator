<?php
namespace Cygnite\Common\ArrayManipulator;

interface ArrayAccessorInterface
{
     /**
     * @param array $array
     * @return $this
     */
    public function set(array $array);

    /**
     * Return array
     *
     * @return array
     */
    public function getArray();


    /**
     * Check Array key Existence
     *
     * @param $key
     * @return mixed
     */
    public function has($key);

    /**
     * We will convert array to json objects
     * @return string
     */
    public function asJson();

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getValue($key, $default = '');
}