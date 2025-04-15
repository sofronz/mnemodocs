<?php
namespace App\Http\Requests\Taxonomy;

use App\Models\Taxonomy;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'        => 'required',
            'status'      => 'required',
            'description' => 'nullable',
        ];
    }

    /**
     * @return array
     */
    public function fieldInputs()
    {
        $parent = $this->parent();

        return [
            'name'        => $this->name,
            'slug'        => $this->parent()->slug . '-' . Str::slug($this->name),
            'description' => $this->description,
            'status'      => $this->status,
            'parent_id'   => $parent->id,
        ];
    }

    /**
     * @return Taxonomy
     */
    public function parent()
    {
        return Taxonomy::where('slug', 'categories')->first();
    }
}
