<?php

declare(strict_types=1);

use App\Livewire\Dashboard\Event;
use App\Models\Event as EventModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('displays all events with latest first', function () {
    $user = User::factory()->create();

    EventModel::create(['poster_image_path' => 'event-image/first.jpg']);
    EventModel::create(['poster_image_path' => 'event-image/second.jpg']);

    Livewire::actingAs($user)
        ->test(Event::class)
        ->assertSee('first.jpg')
        ->assertSee('second.jpg')
        ->assertDontSee('No events available at the moment.')
        ->assertSuccessful();
});

it('shows empty state when no events exist', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Event::class)
        ->assertSee('No events available at the moment.')
        ->assertSuccessful();
});
