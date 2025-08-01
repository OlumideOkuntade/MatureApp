<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $this->user()->can(['manage_products','manage_users'], $user);
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'quantity' => 'required|integer',
            'status'=> 'required',
        ];
    }
}
