<?php

namespace App\Services;

use App\Models\Pokemon;

class PokemonService
{
    private string $cacheDir = '/var/www/html/cache/';
    private int $cacheTtl = 60; // 1 hora

    public function getPokemon(string $idOrName): Pokemon
    {
        $cacheFile = $this->cacheDir . strtolower($idOrName) . '.json';

        // Verifica si existe un archivo en caché aún válido
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $this->cacheTtl)) {
            $json = file_get_contents($cacheFile);
        } else {
            $url = "https://pokeapi.co/api/v2/pokemon/{$idOrName}";
            $json = @file_get_contents($url);

            if (!$json) {
                throw new \Exception("Pokémon no encontrado.");
            }

            // Si la carpeta no existe, la crea
            if (!is_dir($this->cacheDir)) {
                mkdir($this->cacheDir, 0777, true);
            }

            // Intenta guardar el archivo en caché
            if (file_put_contents($cacheFile, $json) === false) {
                error_log("No se pudo guardar en caché: $cacheFile");
            } else {
                error_log("Caché guardado: $cacheFile");
            }
        }

        $data = json_decode($json, true);

        return new Pokemon([
            "id" => $data["id"],
            "name" => $data["name"],
            "types" => array_map(fn($t) => $t["type"]["name"], $data["types"]),
            "abilities" => array_map(fn($a) => $a["ability"]["name"], $data["abilities"]),
            "sprite_url" => $data["sprites"]["front_default"]
        ]);
    }
}
