<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_all_students()
    {
        Student::factory()->count(5)->create();
    
        $response = $this->getJson('/api/students');
    
        $response->assertStatus(200);
    
        // Debugging respons JSON
        $response->dump();
    }
    

    #[Test]
    public function it_can_create_a_student()
    {
        $studentData = Student::factory()->make()->toArray();

        $response = $this->postJson('/api/students', $studentData);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Student successfully created']);

        $this->assertDatabaseHas('hr.ms_student', [
            'email' => $studentData['email']
        ]);
    }

    #[Test]
    public function it_can_show_a_student()
    {
        $student = Student::factory()->create();

        $response = $this->getJson('/api/students/' . $student->student_number);

        $response->assertStatus(200)
                 ->assertJson([
                     'student_number' => $student->student_number
                 ]);
    }

    #[Test]
    public function it_can_update_a_student()
    {
        $student = Student::factory()->create();

        $updatedData = [
            'fullname' => 'Updated Name',
            'email' => 'updatedemail@example.com'
        ];

        $response = $this->putJson('/api/students/' . $student->student_number, $updatedData);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Student successfully updated']);

        $this->assertDatabaseHas('hr.ms_student', [
            'student_number' => $student->student_number,
            'fullname' => 'Updated Name',
            'email' => 'updatedemail@example.com'
        ]);
    }

    #[Test]
    public function it_can_delete_a_student()
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson('/api/students/' . $student->student_number);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Student successfully deleted']);

        $this->assertDatabaseMissing('hr.ms_student', [
            'student_number' => $student->student_number
        ]);
    }
}
