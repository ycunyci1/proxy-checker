<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProxyRequest;
use App\Http\Resources\ProxyResource;
use App\Models\ProxyResult;
use App\Services\ProxyCheckServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function check(ProxyRequest $request): JsonResponse
    {
        $data = $request->validated();
        $info = app(ProxyCheckServiceInterface::class)->check($data['proxies']);

        return response()->json($info);
    }

    public function checkProcess(Request $request)
    {
        $data = $request->validate([
            'key' => 'string|required',
            'count' => 'int|required',
        ]);
        $results = app(ProxyCheckServiceInterface::class)->checkProcess($data);

        if (gettype($results) == 'array') {
            return response()->json($results, 202);
        }

        return response()->json([
            'proxies' => ProxyResource::collection($results),
            'results' => [
                'failed' => $results->where('work', 0)->count(),
                'successful' => $results->where('work', 1)->count(),
            ],
        ]);

    }

    public function history()
    {
        return view('history', [
            'proxies' => ProxyResult::query()->latest()->limit(50)->get(),
        ]);
    }
}
