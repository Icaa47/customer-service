<?php

namespace Tests\Unit;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ProfileUpdateRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function makeRequest(User $user): ProfileUpdateRequest
    {
        $request = new ProfileUpdateRequest();
        $request->setContainer(app());
        $request->setUserResolver(fn () => $user);

        return $request;
    }

    public function test_email_must_be_lowercase(): void
    {
        $user = User::factory()->create();
        $request = $this->makeRequest($user);

        $validator = Validator::make([
            'name' => 'New Name',
            'email' => strtoupper($user->email),
        ], $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertSame('The email field must be lowercase.', $validator->errors()->first('email'));
    }

    public function test_user_can_keep_their_existing_email(): void
    {
        $user = User::factory()->create(['email' => 'person@example.com']);
        $request = $this->makeRequest($user);

        $validator = Validator::make([
            'name' => 'Updated Name',
            'email' => 'person@example.com',
        ], $request->rules());

        $this->assertFalse($validator->fails());
    }

    public function test_email_must_be_unique_among_other_users(): void
    {
        $currentUser = User::factory()->create(['email' => 'owner@example.com']);
        $conflictingUser = User::factory()->create(['email' => 'taken@example.com']);

        $request = $this->makeRequest($currentUser);

        $validator = Validator::make([
            'name' => 'Updated Name',
            'email' => $conflictingUser->email,
        ], $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertSame('The email has already been taken.', $validator->errors()->first('email'));
    }
}
