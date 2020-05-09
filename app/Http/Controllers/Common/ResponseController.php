<?php

namespace App\Http\Controllers\Common;

class ResponseController
{
    const SUCCESS = 200;
    const ERROR = 400;
    const EXCEPTION = 500;

    /**
     * Check and return response.
     *
     *  @param array $data
     *
     * @return object
     */
    public static function response($data = [])
    {
        return response()
                ->json(
                    [
                        'data' => $data,
                    ],
                    self::SUCCESS
                );
    }

    /**
     * Return errors response.
     *
     * @param array $errors
     *
     * @return object
     */
    public static function errors($errors = [])
    {
        return response()
                ->json(
                    [
                        'errors' => $errors,
                    ],
                    self::ERROR
                );
    }

    /**
     * Return exception response.
     *
     * @return object
     */
    public static function exception()
    {
        return response()
                ->json(
                    [
                        'exception' => ['Server not found'],
                    ],
                    self::EXCEPTION
                );
    }
}
