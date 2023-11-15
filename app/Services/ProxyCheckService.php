<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\ProxyCheckJob;
use App\Models\ProxyResult;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProxyCheckService implements ProxyCheckServiceInterface
{
    /**
     * Запустить очереди для проверки работоспособность прокси
     */
    public function check(string $data): array
    {
        $proxiesInfo = FormattingProxiesService::getFormattedProxiesGroupsArr($data, 10);
        $key = $this->keyGenerate();
        foreach ($proxiesInfo['array'] as $group) {
            ProxyCheckJob::dispatch($group, $key);
        }

        return [
            'key' => $key,
            'count' => $proxiesInfo['count'],
        ];
    }

    /**
     * Проверить процесс выполнения очередей
     */
    public function checkProcess(array $data): Collection|array
    {
        $results = ProxyResult::query()->where('key', $data['key'])->orderByDesc('work')->get();
        $currentCount = $results->count();

        return $data['count'] == $results->count() ? $results : ['currentCount' => $currentCount, 'maxCount' => $data['count']];
    }

    /**
     * Действия после проверок работоспособности прокси
     */
    public function createProxyResultsFromResponses(array $results, array $timing, string $key): void
    {
        $ip = app(UserInfoService::class)->getIp();
        foreach ($results as $proxy => $data) {
            if ($data !== null) {
                $data['kind'] = $data['query'] != $ip;
                $data['work'] = 1;
                $data['timing'] = $timing[$proxy];
            }
            $data['key'] = $key;
            $data['ip_port'] = $proxy;
            ProxyResult::query()->create($data);
        }
    }

    /**
     * Сгенерировать уникальный ключ для текущего запроса
     */
    public function keyGenerate(): string
    {
        return Str::random(10).rand(0, 10000);
    }
}
