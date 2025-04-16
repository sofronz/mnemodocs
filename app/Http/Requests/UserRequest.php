<?php
namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required',
            'role'     => 'required',
        ];
        
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $userId = $this->route('id') ?? $this->route('user');

            $rules['email']    = 'unique:users,email,' . $userId;
            $rules['password'] = 'nullable';
        } else {
            $rules['email']    = 'unique:users,email';
            $rules['password'] = 'required';
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function fieldInputs()
    {
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $arr = [
                'name'     => $this->name,
                'email'    => $this->email,
                'role_id'  => $this->role,
            ];

            if (! is_null($this->password)) {
                $arr['password'] = Hash::make($this->password);
            }

            return $arr;
        }

        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role_id'  => $this->role,
        ];
    }
}
