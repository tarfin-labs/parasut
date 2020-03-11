<?php

namespace TarfinLabs\Parasut\Exceptions;

use GuzzleHttp\Exception\ClientException;

class ParasutException extends \Exception
{
    public static function _400(ClientException $exception)
    {
        return self::build($exception);
    }

    private static function build(ClientException $exception)
    {
        if ($exception->hasResponse()) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            http_response_code($exception->getResponse()->getStatusCode());
            $msg = '';
            if (!$response) {
                $msg = 'Parasut error : '.$exception->getResponse()->getStatusCode();
            } else {
                $msg .= !property_exists($response->errors[0], 'title') ? '' : $response->errors[0]->title.' => ';
                $msg .= !property_exists($response->errors[0], 'detail') ? '' : $response->errors[0]->detail;
            }

            return new static($msg);
        }

        return new static ($exception->getMessage());
    }

    public static function _401(ClientException $exception)
    {
        return self::build($exception);
    }

    public static function _403(ClientException $exception)
    {
        return self::build($exception);
    }

    public static function _404(ClientException $exception)
    {
        return self::build($exception);
    }

    public static function _422(ClientException $exception)
    {
        return self::build($exception);
    }

    public static function _429(ClientException $exception)
    {
        return self::build($exception);
    }
}
