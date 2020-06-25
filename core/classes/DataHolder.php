<?php

namespace Core;

class DataHolder
{
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->_setData($data);
        }
    }

    public function __set($property_key, $value)
    {
        $setter = $this->_getSetterFor($property_key);
        if ($setter) {
            $this->$setter($value);
        }
    }

    public function __get($property_key)
    {
        $getter = $this->_getGetterFor($property_key);
        if ($getter) {
            return $this->$getter();
        }
    }

    private function _keyToMethod($prefix, $property_key)
    {
        $method = str_replace('_', '', $prefix . $property_key);
        return $method;
    }

    private function _getSetterFor($property_key)
    {
        $method_name = $this->_keyToMethod('set', $property_key);
        return method_exists($this, $method_name) ? $method_name : null;
    }

    private function _getGetterFor($property_key)
    {
        $method_name = $this->_keyToMethod('get', $property_key);
        return method_exists($this, $method_name) ? $method_name : null;
    }

    private function _methodToKey($prefix, $method)
    {
        $snake_case = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $method));
        $key =  preg_replace("/^{$prefix}_/", '', $snake_case);
        return $key;
    }

    private function _getPropertyKeys()
    {
        $properties = [];
        $methods = get_class_methods($this);

        foreach ($methods as $method) {
            if (strpos($method, 'get') === 0) {
                $properties[] = $this->_methodToKey('get', $method);
            }
        }

        return $properties;
    }

    public function _setData(array $data)
    {
        foreach ($data as $property_key => $value) {
            $setter = $this->_getSetterFor($property_key);
            if ($setter) {
                $this->$setter($value);
            }
        }
    }
    
    public function _getData()
    {
        $data = [];

        foreach ($this->_getPropertyKeys() as $property_key) {
            $method_name = $this->_getGetterFor($property_key);
            $property = $this->$method_name();

            if ($property !== null) {
                $data[$property_key] = $property;
            }
        }

        return $data;
    }
}