<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ];
    }
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'))) {
            // Tăng số lần thử đăng nhập thất bại
            $count = RateLimiter::hit($this->throttleKey());
            // Tính số lần thử còn lại
            $attemptsLeft = 5 - $count;
            $seconds = RateLimiter::availableIn($this->throttleKey());
            if($attemptsLeft === 0){
                throw ValidationException::withMessages([
                    'attempts_left' => trans('auth.throttle', [
                        'seconds' => $seconds,
                        'minutes' => ceil($seconds / 60),
                    ]),
                ]);
            }else{
                throw ValidationException::withMessages([
                    'attempts_left' => "Email hoặc Mật khẩu không đúng - Bạn còn $attemptsLeft lần thử."
                ]);
            }
        }
        // Nếu đăng nhập thành công, xóa rate limiter
        RateLimiter::clear($this->throttleKey());
    }
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
    }
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
