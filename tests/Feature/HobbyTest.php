<?php

namespace Tests\Feature;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HobbyTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_hobby()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('hobbies.store'), [
            'name' => 'makan',
            'description' => 'dimakan'
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('hobbies', [
            'name' => 'makan',
            'description' => 'dimakan'
        ]);
    }

    public function test_read_hobbies()
    {
        $hobby = Hobby::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('hobbies.index'));

        $response->assertOk();
        $response->assertSee($hobby->name);
    }

    public function test_update_hobby()
    {
        $hobby = Hobby::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->put(route('hobbies.update', $hobby->id), [
            'name' => 'anu',
            'description' => 'di anu'
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('hobbies', [
            'name' => 'anu',
            'description' => 'di anu'
        ]);
    }

    public function test_delete_hobby()
    {
        $hobby = Hobby::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->delete(route('hobbies.destroy', $hobby->id));

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('hobbies', [
            'id' => $hobby->id
        ]);
    }
}
