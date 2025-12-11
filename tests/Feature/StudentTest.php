<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_students()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('students.store'), [
            'name' => 'restu',
            'nisn' => '1234',
            'phones' => ['13123123123']
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('students', [
            'name' => 'restu'
        ]);
    }

    public function test_read_students()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->from(route('students.index'))->post(route('students.store'), [
            'name' => 'restu',
            'nisn' => '123123',
            'phones' => ['123412341342']
        ]);

        $student = Student::where('name', 'restu')->first();

        $this->assertNotNull($student);
        $this->assertDatabaseHas('nisns', ['nisn' => '123123']);
        $this->assertDatabaseHas('phones', ['number' => '123412341342']);
    }

    public function test_update_student()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->from(route('students.index'))->post(route('students.store'), [
            'name' => 'restu',
            'nisn' => '123123',
            'phones' => ['123412341342']
        ]);

        $student = Student::where('name', 'restu')->first();

        $this->from(route('hobbies.index'))->put(route('students.update', $student->id), [
            'name' => 'ardi',
            'nisn' => '5000',
            'phones' => ['123412341342']
        ]);

        $this->assertDatabaseHas('students', ['name' => 'ardi']);
        $this->assertDatabaseHas('nisns', ['nisn' => '5000']);
        $this->assertDatabaseHas('phones', ['number' => '123412341342']);
    }

    public function test_delete_student()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->from(route('students.index'))->post(route('students.store'), [
            'name' => 'restu',
            'nisn' => '123123',
            'phones' => ['123412341342']
        ]);

        $student = Student::where('name', 'restu')->first();

        $this->from(route('students.index'))->delete(route('students.destroy', $student->id));

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
        $this->assertDatabaseMissing('nisns', ['student_id' => $student->id]);
        $this->assertDatabaseMissing('phones', ['student_id' => $student->id]);
    }
}
