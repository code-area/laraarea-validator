<?php

namespace LaraAreaValidator\Providers;

use Illuminate\Support\Facades\Validator;
use LaraAreaValidator\Rules\UniqueRule;
use LaraAreaValidator\ValidatorServiceProvider;

class AreaValidatorServiceProvider extends ValidatorServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $rule = new UniqueRule();
        Validator::extend($rule->getRule(), UniqueRule::class, $rule->message());
    }

    /**
     * Register extended Rules
     *
     * @param array $extendedClasses
     */
    public function bootExtendedRules($extendedClasses = [])
    {
        foreach ($extendedClasses as $class) {
            $rule = (new $class);
            Validator::extend($rule->getRule(), $class, $rule->message());
        }
    }

    /**
     * Alias method for extend new rule
     *
     * @param $name
     * @param $callback
     */
    protected function extend($name, $callback)
    {
        Validator::extend($name, $callback);
    }
}
