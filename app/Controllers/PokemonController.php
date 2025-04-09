<?php

namespace App\Controllers;

use App\Services\PokemonService;

class PokemonController
{
    private PokemonService $service;

    public function __construct()
    {
        $this->service = new PokemonService();
    }

    public function show(string $idOrName): array
    {
        try {
            return $this->service->getPokemon($idOrName);
        } catch (\Exception $e) {
            http_response_code(404);
            return ["error" => $e->getMessage()];
        }
    }
}
