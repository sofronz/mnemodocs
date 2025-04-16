<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'title'       => 'required',
            'description' => 'nullable',
            'status'      => 'required',
            'category'    => 'required',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['file'] = 'nullable|file|mimes:pdf|mimetypes:application/pdf|min:100|max:500';
        } else {
            $rules['file'] = 'required|file|mimes:pdf|mimetypes:application/pdf|min:100|max:500';
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
                'title'       => $this->title,
                'description' => $this->description,
                'status'      => $this->status,
                'category_id' => $this->category,
            ];

            if (! is_null($this->file)) {
                $arr['file'] = $this->file;
            }

            return $arr;
        }

        return [
            'title'       => $this->title,
            'description' => $this->description,
            'uploaded_by' => $this->user()->id,
            'status'      => $this->status,
            'category_id' => $this->category,
            'file'        => $this->file,
        ];
    }
}
