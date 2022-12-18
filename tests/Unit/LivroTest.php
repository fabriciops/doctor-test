<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class LivroTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testseacherlivro()
    {
        $response = $this->get('/v1/livros/?titulo_do_indice=indice');

        $response->assertStatus(404);
    }

    /**
     * Pegar Token
     *
     * @return void
     */
    public function getLivros()
    {
        $response = $this->json('GET', 'api/v1/livros/?titulo_do_indice=indice');
        
        $response->assertStatus(200);
    }
}
