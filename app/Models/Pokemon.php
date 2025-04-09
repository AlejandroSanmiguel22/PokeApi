<?php

namespace App\Models;

class Pokemon
{
    public int $id;
    public string $name;
    public array $types;
    public array $abilities;
    public string $sprite_url;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->types = $data['types'];
        $this->abilities = $data['abilities'];
        $this->sprite_url = $data['sprite_url'];
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "types" => $this->types,
            "abilities" => $this->abilities,
            "sprite_url" => $this->sprite_url
        ];
    }
}
