<?php

namespace Mhassan654\LicenseSupport\Support;

use Exception;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class IpSupport
{
    /**
     * Check client is from localhost
     *
     * @source https://stackoverflow.com/a/21702853/6940144
     *
     * @return bool
     */
    public static function isLocalhost(): bool
    {
        return in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1', '172.27.0.1']);
    }

    /**
     * Get client public IP address if it is localhost
     *
     * @return null | string
     */
    public static function getLocalhostPublicIp(): null | string
    {
        $ipAddress = null;

        // TODO: Add config option to disable this feature
        $response = Http::withoutVerifying()->get('https://api.ipify.org/?format=json');

        if ($response->ok()) {
            $ipAddress = $response->json()['ip'] ?? null;

            if (!empty($ipAddress)) {
                return $ipAddress;
            }
        }

        return $ipAddress;
    }

    /**
     * Get client real IP address
     *
     * @source https://stackoverflow.com/q/13646690/6940144
     *
     * @param bool $getLocalPublicIp
     *
     * @return string
     */
    public static function getIP(bool $getLocalPublicIp = true): string
    {
        $baseIp = $_SERVER['REMOTE_ADDR'];

        try {
            // get localhost public ip
            if ($getLocalPublicIp && self::isLocalhost()) {
                return self::getLocalhostPublicIp();
            }

            // check other conditions, cloudflare etc
            if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && filter_var($_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
                return $_SERVER['HTTP_CF_CONNECTING_IP'];
            } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && filter_var($_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
                return $_SERVER['HTTP_X_REAL_IP'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                return $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } catch (Exception $exp) {
            // TODO: add config option to logging errors
            Log::alert('getIP error', ['error' => $exp]);

            // TODO: add custom exception
            throw $exp;
        }

        return $baseIp;
    }
}
