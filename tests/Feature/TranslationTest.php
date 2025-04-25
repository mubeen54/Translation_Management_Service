<?php

// test('example', function () {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });

use App\Models\Transaltion;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Artisan::call('migrate');
    Sanctum::actingAs(User::factory()->create());
});

it('can fetch translations list', function () {
    Transaltion::factory()->count(5)->create();

    $response = $this->getJson('/api/translations');

    $response->assertOk();
    $response->assertJsonStructure(['data']);
});

it('can store a new translation', function () {
    $payload = [
        'locale' => 'en',
        'key' => 'welcome',
        'value' => 'Welcome',
        'tags' => ['web'],
    ];
    $response = $this->postJson('/api/store/translations', $payload);

    $response->assertCreated();
    $this->assertDatabaseHas('transaltions', ['key' => 'welcome']);
});

it('can update a translation', function () {
    $translation = Transaltion::factory()->create();

    $response = $this->postJson("/api/translations/{$translation->id}", [
        'locale' => $translation->locale,
        'key' => $translation->key,
        'value' => 'Updated Value',
        'tags' => $translation->tags,
    ]);

    $response->assertOk();
    $this->assertEquals('Updated Value', $translation->fresh()->value);
});

it('can show a translation', function () {
    $translation = Transaltion::factory()->create();

    $response = $this->getJson("/api/translations/{$translation->id}");

    $response->assertOk();
    $response->assertJsonFragment(['key' => $translation->key]);
});

it('can export translations by locale', function () {
    Transaltion::factory()->create([
        'locale' => 'en',
        'key' => 'greeting',
        'value' => 'Hello',
    ]);

    $response = $this->getJson('/api/translations/export/en');

    $response->assertOk();
    $response->assertJsonFragment(['greeting' => 'Hello']);
});
