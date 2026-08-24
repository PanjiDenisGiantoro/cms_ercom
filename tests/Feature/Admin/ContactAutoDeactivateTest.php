<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

function actingAsAdmin(): User
{
    $role = Role::firstOrCreate(['name' => 'admin']);
    $user = User::factory()->create();
    $user->assignRole($role);

    test()->actingAs($user);

    return $user;
}

test('creating an active contact deactivates other contacts', function () {
    actingAsAdmin();

    $existing = Contact::factory()->create(['is_active' => true]);

    $this->post(route('admin.contacts.store'), [
        'label' => 'New Office',
        'is_active' => '1',
        'order' => 0,
    ])->assertRedirect(route('admin.contacts.index'));

    expect($existing->fresh()->is_active)->toBeFalse();
    expect(Contact::where('label', 'New Office')->first()->is_active)->toBeTrue();
});

test('updating a contact to active deactivates other contacts', function () {
    actingAsAdmin();

    $a = Contact::factory()->create(['is_active' => true]);
    $b = Contact::factory()->create(['is_active' => false]);

    $this->put(route('admin.contacts.update', $b), [
        'label' => $b->label,
        'is_active' => '1',
        'order' => $b->order,
    ])->assertRedirect(route('admin.contacts.index'));

    expect($a->fresh()->is_active)->toBeFalse();
    expect($b->fresh()->is_active)->toBeTrue();
});

test('creating an inactive contact does not touch other contacts', function () {
    actingAsAdmin();

    $existing = Contact::factory()->create(['is_active' => true]);

    $this->post(route('admin.contacts.store'), [
        'label' => 'Draft Office',
        'order' => 0,
    ])->assertRedirect(route('admin.contacts.index'));

    expect($existing->fresh()->is_active)->toBeTrue();
});
