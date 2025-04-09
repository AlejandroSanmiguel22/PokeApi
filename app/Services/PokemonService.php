<?php

namespace App\Services;

class PokemonService
{
    public function getPokemon(string $idOrName): array
    {
        $url = "https://pokeapi.co/api/v2/pokemon/{$idOrName}";
        $json = @file_get_contents($url);

        if (!$json) {
            throw new \Exception("Pokémon no encontrado.");
        }

        $data = json_decode($json, true);

        return [
            "id" => $data["id"],
            "name" => $data["name"],
            "types" => array_map(fn($t) => $t["type"]["name"], $data["types"]),
            "abilities" => array_map(fn($a) => $a["ability"]["name"], $data["abilities"]),
            "sprite_url" => $data["sprites"]["front_default"]
        ];
    }
}
