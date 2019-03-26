<?php
namespace App\Providers;
use Illuminate\Support\Str;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class CustomUserProvider extends EloquentUserProvider
{
  /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('senha', $credentials))) {
            return;
        }
        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();
        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'senha')) {
                $query->where($key, $value);
            }
        }
        return $query->first();
    }
    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['senha'];
        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}