<?php

namespace Tests\Unit;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function makeRequest(array $data = []): LoginRequest
    {
        $defaults = [
            'email' => 'user@example.com',
            'password' => 'password',
        ];

        $request = LoginRequest::create('/login', 'POST', array_merge($defaults, $data));
        $request->setContainer(app());
        $request->server->set('REMOTE_ADDR', '127.0.0.1');

        return $request;
    }

    public function test_throttle_key_uses_lowercase_email_and_ip(): void
    {
        $request = $this->makeRequest(['email' => 'USER@Example.com']);

        $this->assertSame('user@example.com|127.0.0.1', $request->throttleKey());
    }

    public function test_ensure_is_not_rate_limited_throws_validation_exception(): void
    {
        $request = $this->makeRequest();

        Event::fake();

        RateLimiter::shouldReceive('tooManyAttempts')
            ->once()
            ->with($request->throttleKey(), 5)
            ->andReturn(true);

        RateLimiter::shouldReceive('availableIn')
            ->once()
            ->with($request->throttleKey())
            ->andReturn(60);

        $this->expectException(ValidationException::class);

        try {
            $request->ensureIsNotRateLimited();
        } catch (ValidationException $exception) {
            Event::assertDispatched(Lockout::class);
            $this->assertArrayHasKey('email', $exception->errors());

            throw $exception;
        }
    }

    public function test_authenticate_logs_in_valid_credentials(): void
    {
        $user = User::factory()->create(['email' => 'user@example.com']);

        $request = $this->makeRequest();
        $request->setLaravelSession(app('session')->driver());

        $this->assertFalse(Auth::check());

        $request->authenticate();

        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticate_increments_rate_limiter_on_failure(): void
    {
        $request = $this->makeRequest(['password' => 'wrong-password']);
        $request->setLaravelSession(app('session')->driver());

        RateLimiter::clear($request->throttleKey());

        $this->expectException(ValidationException::class);

        try {
            $request->authenticate();
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('email', $exception->errors());
            $this->assertTrue(RateLimiter::tooManyAttempts($request->throttleKey(), 1));

            throw $exception;
        }
    }
}
