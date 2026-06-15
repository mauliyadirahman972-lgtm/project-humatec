<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdRecyclingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that deleted IDs are recycled correctly.
     */
    public function test_recycles_deleted_ids_correctly(): void
    {
        // 1. Create three employees
        $emp1 = Employee::create(['name' => 'Karyawan 1', 'email' => 'emp1@example.com']);
        $emp2 = Employee::create(['name' => 'Karyawan 2', 'email' => 'emp2@example.com']);
        $emp3 = Employee::create(['name' => 'Karyawan 3', 'email' => 'emp3@example.com']);

        // Check if they got sequentially assigned IDs starting from 1
        $this->assertEquals(1, $emp1->id);
        $this->assertEquals(2, $emp2->id);
        $this->assertEquals(3, $emp3->id);

        // 2. Delete the second employee (ID = 2)
        $emp2->delete();

        // 3. Create a new employee, it should occupy ID 2 (recycled)
        $empNew = Employee::create(['name' => 'Karyawan Baru 1', 'email' => 'new1@example.com']);
        $this->assertEquals(2, $empNew->id);

        // 4. Create another employee, it should occupy ID 4 (since 1, 2, 3 are now occupied)
        $empNext = Employee::create(['name' => 'Karyawan Baru 2', 'email' => 'new2@example.com']);
        $this->assertEquals(4, $empNext->id);

        // 5. Delete employee with ID 1
        $emp1->delete();

        // 6. Create a new employee, it should occupy ID 1 (recycled)
        $empFirstRecycled = Employee::create(['name' => 'Karyawan Baru 3', 'email' => 'new3@example.com']);
        $this->assertEquals(1, $empFirstRecycled->id);
    }

    /**
     * Test that the recycling works for other models as well (e.g. Project, Label).
     */
    public function test_recycles_ids_for_other_models(): void
    {
        // Projects
        $p1 = Project::create(['name' => 'Proyek A', 'start_date' => '2026-01-01', 'end_date' => '2026-12-31', 'status' => 'Planning']);
        $p2 = Project::create(['name' => 'Proyek B', 'start_date' => '2026-01-01', 'end_date' => '2026-12-31', 'status' => 'In Progress']);
        $this->assertEquals(1, $p1->id);
        $this->assertEquals(2, $p2->id);

        $p1->delete();

        $pNew = Project::create(['name' => 'Proyek C', 'start_date' => '2026-01-01', 'end_date' => '2026-12-31', 'status' => 'Planning']);
        $this->assertEquals(1, $pNew->id);

        // Labels
        $l1 = Label::create(['name' => 'Label 1']);
        $l2 = Label::create(['name' => 'Label 2']);
        $this->assertEquals(1, $l1->id);
        $this->assertEquals(2, $l2->id);

        $l1->delete();

        $lNew = Label::create(['name' => 'Label Baru']);
        $this->assertEquals(1, $lNew->id);
    }
}
