<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        // $response = $this->post('/book');
        $this->postJson('book', 
        ['type' => 'SamplehhllhjhhBook',
         'categorie' => 'John Doe',
         'langue' => 'John Doe',
         'editeur' => 'John Doe',
         'designation' => 'John Doe',
         'auteur' => 'John Doe',
         'description' => 'John Doe',
         'prix' => 200 ,
        ]);

        // $response->assertStatus(200);
    }

    public function test_delete()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create(); // Create a user

        $this->actingAs($user);

        $response = $this->delete("/book/{$book->id}");
        $response->assertStatus(204); // Change to 204 if your API returns no content

        $this->assertDatabaseMissing('books', ['id' => $book->id]); //
    }

    public function test_index()
    {
        $response = $this->get('/book');
        $response->assertStatus(301);
    }
}
