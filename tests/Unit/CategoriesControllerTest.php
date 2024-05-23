<?php

namespace Tests\Unit;

use App\Http\Livewire\CategoriesController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_category()
    {
        Livewire::test(CategoriesController::class)
            ->set('category_name', 'Test Category')
            ->set('description', 'Test Description')
            ->call('Store');

        $this->assertDatabaseHas('categories', [
            'category_name' => 'Test Category',
            'description' => 'Test Description',
        ]);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();

        Livewire::test(CategoriesController::class)
            ->set('selected_id', $category->id)
            ->set('category_name', 'Updated Category Name')
            ->set('description', 'Updated Description')
            ->call('Update');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'category_name' => 'Updated Category Name',
            'description' => 'Updated Description',
        ]);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        Livewire::test(CategoriesController::class)
            ->set('selected_id', $category->id)
            ->call('Destroy', $category);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
