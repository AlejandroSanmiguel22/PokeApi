<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Services\PokemonService;
use App\Models\Pokemon;

class PokemonServiceTest extends TestCase
{
    public function testReturnsPokemonData()
    {
        $service = new PokemonService();
        $pokemon = $service->getPokemon("pikachu");

        $this->assertInstanceOf(Pokemon::class, $pokemon);
        $this->assertEquals("pikachu", strtolower($pokemon->name));
        $this->assertContains("electric", $pokemon->types);
    }
}
