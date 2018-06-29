<?php

namespace App\Utilities;

use GuzzleHttp\Client;

class Personas extends GuzzleHttpRequest
{
    
    public function all()
    {
        return $this->get('personas');
    }

    public function find($id)
    {
        return $this->get("personas/{$id}");
    }


    public function destroy($id)
    {
        return $this->delete("personas/{$id}");
    }


}