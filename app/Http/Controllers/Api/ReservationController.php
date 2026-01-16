<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateReservationRequest;
use App\Services\ReservationService;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    private ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * 予約作成
     */
    public function store(CreateReservationRequest $request): JsonResponse
    {
        try {
            $result = $this->reservationService->createReservation($request->validated());

            return response()->json([
                'success' => true,
                'data' => $result,
            ], 201);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * 例外をJSONレスポンスに変換
     */
    private function handleException(\Exception $e): JsonResponse
    {
        $message = $e->getMessage();

        // SLOT_CONFLICT:14:00,14:30 形式の場合
        if (str_starts_with($message, 'SLOT_CONFLICT:')) {
            $slots = explode(',', substr($message, 14));
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'SLOT_CONFLICT',
                    'message' => '指定された時間帯は既に予約が入っています',
                    'conflicting_slots' => $slots,
                ],
            ], 409);
        }

        $errorMap = [
            'USER_NOT_FOUND' => [
                'status' => 404,
                'message' => 'LINE連携されていないユーザーです',
            ],
            'STAFF_NOT_FOUND' => [
                'status' => 404,
                'message' => '指定されたスタッフが存在しないか無効です',
            ],
            'MENU_NOT_FOUND' => [
                'status' => 404,
                'message' => '指定されたメニューが存在しないか無効です',
            ],
        ];

        if (isset($errorMap[$message])) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => $message,
                    'message' => $errorMap[$message]['message'],
                ],
            ], $errorMap[$message]['status']);
        }

        // 予期しないエラー
        return response()->json([
            'success' => false,
            'error' => [
                'code' => 'INTERNAL_ERROR',
                'message' => 'サーバーエラーが発生しました',
            ],
        ], 500);
    }
}
