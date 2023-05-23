<?php

namespace Savannabits\KualiCompanion;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\RequestException;
use Savannabits\KualiCompanion\Services\EnterpriseFeed;
use Savannabits\KualiCompanion\Services\KualiPaymentVoucher;

class KualiCompanion
{
    public function enterpriseFeedService(string $fileBaseName, ?string $disk = null): EnterpriseFeed
    {
        if (!$disk) $disk = config('kuali-companion.ef.default_disk','local');
        return EnterpriseFeed::init($fileBaseName, $disk);
    }
    public function paymentVoucher(): KualiPaymentVoucher
    {
        return KualiPaymentVoucher::init();
    }

    public function postPV(string $encryptedPayload) {
        $externalSystemUrl = $this->getUrl(config('kuali-companion.http.pv_endpoint'),
            ['{iv}' => config('sucipher.iv')]
        );
        try {
            $response = \Http::withoutVerifying()->post($externalSystemUrl,[$encryptedPayload])->throw()->body();
            \Log::info("KFS Response:");
            \Log::info($response);
            /*if ($response !='012') {
                abort(500, 'Payment was not successfully posted to KFS');
            }*/
            \Log::info("POST Successful:");
            return $response;
        } catch (RequestException $exception) {
            \Log::error($exception->response->body());
            return false;
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return false;
        }
    }
    public function getUrl(string $endpoint, array $substitutions = []): string
    {
        $base = rtrim(config('kuali-companion.base_url'),'/');
        $path = ltrim($endpoint,'/');
        $fullUrl = \Str::of($base)->append('/')->append($path);
        foreach ($substitutions as $key => $substitution) {
            $fullUrl = $fullUrl->replace($key,$substitution);
        }
        return $fullUrl->toString();
    }
}
