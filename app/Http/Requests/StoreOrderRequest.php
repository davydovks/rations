<?php

namespace App\Http\Requests;

use App\Enums\ScheduleType;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        [$firstDate, $lastDate] = array_reduce($this->daterange, function ($carry, $range) {
            if (empty($range)) {
                return $carry;
            }
            $dates = explode(' - ', $range);
            if (empty($carry)) {
                return $dates;
            }
            return [
                min($carry[0], $dates[0]),
                max($carry[1], $dates[1])
            ];
        });
        $this->merge([
            'client_phone' => preg_replace('/[^\d]/', '', $this->client_phone),
            'first_date' => $firstDate,
            'last_date' => $lastDate,
            'daterange' => array_filter($this->daterange, fn($item) => $item != null),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|size:11|unique:orders,client_phone',
            'tariff_id' => 'required|exists:tariffs,id',
            'schedule_type' => [Rule::enum(ScheduleType::class)],
            'comment' => 'string|nullable',
            'first_date' => 'required|string',
            'last_date' => 'required|string',
            'daterange' => 'required|array',
        ];
    }
}
