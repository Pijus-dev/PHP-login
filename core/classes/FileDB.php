<?php

class FileDB
{
    private $file_name;
    private $data;

    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    public function setData(array $data_array)
    {
        $this->data = $data_array;
    }

    public function save()
    {
        array_to_file($this->data, $this->file_name);
    }

    public function load()
    {
       $data_array = file_to_array($this->file_name);
       $this->data = $data_array ? $data_array : []; 
    }

    public function getData()
    {
        return $this->data;
    }
}
