<?php

namespace App\Http\Requests\V1\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int $market
 * @property string $name
 * @property string $guard_name
 */
class MarketSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    #[ArrayShape(['title' => "string[]", 'name' => "string[]", 'enabled' => "string[]", 'description' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'name' => ['required', 'string'],
            'enabled' => ['required', 'boolean'],
            'description' => ['required', 'string'],
        ];
    }
}
