<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_validation_works()
    {
        $response = $this->post('/posts', [
            'title' => '',
            'content' => '',
        ]);

        $response->assertSessionHasErrors(['title', 'content', 'user_id']);
    }

    public function test_comment_validation_works()
    {
        $response = $this->post('/comments', [
            'content' => '',
        ]);

        $response->assertSessionHasErrors(['user_id', 'post_id', 'content']);
    }

    public function test_tag_validation_works()
    {
        $response = $this->post('/tags', [
            'name' => '',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_like_validation_works()
    {
        $response = $this->post('/likes', []);

        $response->assertSessionHasErrors(['user_id', 'post_id']);
    }

    public function test_my_super_exception_web_response()
    {
        $response = $this->get('/test-exception');

        $response->assertStatus(418);
        $response->assertSee('🚨 Супер помилка!');
        $response->assertSee('Це тестова супер помилка!');
    }

    public function test_my_super_exception_api_response()
    {
        $response = $this->getJson('/api/test-exception');

        $response->assertStatus(418);
        $response->assertJson([
            'error' => 'MySuperException',
            'message' => 'Це тестова супер помилка для API!',
            'code' => 418,
        ]);
        $response->assertJsonStructure([
            'error',
            'message', 
            'code',
            'timestamp'
        ]);
    }
} 