<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'line_user_id'     => 'required|string|max:255',
            'staff_id'         => 'required|integer|exists:staff,id',
            'menu_id'          => 'required|integer|exists:menu,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
        ];
    }

    public function messages(): array
    {
        return [
            'line_user_id.required'     => 'LINE IDは必須です',
            'staff_id.required'         => 'スタッフIDは必須です',
            'staff_id.exists'           => '指定されたスタッフが存在しません',
            'menu_id.required'          => 'メニューIDは必須です',
            'menu_id.exists'            => '指定されたメニューが存在しません',
            'reservation_date.required' => '予約日は必須です',
            'reservation_date.date'     => '予約日の形式が正しくありません',
            'reservation_date.after_or_equal' => '予約日は今日以降の日付を指定してください',
            'reservation_time.required' => '予約時間は必須です',
            'reservation_time.date_format' => '予約時間はHH:mm形式で指定してください',
        ];
    }

    /**
     * バリデーション失敗時のレスポンス
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => '入力内容に誤りがあります',
                    'details' => $validator->errors()->toArray(),
                ],
            ], 400)
        );
    }
}
