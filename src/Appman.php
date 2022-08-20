<?php

namespace Krakero\Appman;

class Appman
{
    protected $custom_data;

    public function custom($data)
    {
        $this->custom_data = $data;
    }

    public function getCustomData()
    {
        return $this->custom_data;
    }
}
