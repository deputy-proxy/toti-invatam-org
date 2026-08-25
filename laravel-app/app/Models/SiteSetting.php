<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key','value','type','group','label','description'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("site_setting:$key", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if (!$setting) return $default;
            return match ($setting->type) {
                'boolean' => (bool) $setting->value,
                'number'  => is_numeric($setting->value) ? $setting->value + 0 : $default,
                'json'    => json_decode($setting->value, true) ?? $default,
                default   => $setting->value ?? $default,
            };
        });
    }

    public static function set(string $key, mixed $value, string $type = 'string', string $group = 'general'): void
    {
        $stored = $type === 'json' ? json_encode($value) : (string) $value;
        static::updateOrCreate(['key' => $key], ['value' => $stored, 'type' => $type, 'group' => $group]);
        Cache::forget("site_setting:$key");
    }

    protected static function booted(): void
    {
        static::saved(fn ($m) => Cache::forget("site_setting:{$m->key}"));
        static::deleted(fn ($m) => Cache::forget("site_setting:{$m->key}"));
    }
}
