<?php

namespace App\Repositories;

trait ReCaptchaRepository
{   
    /**
     * Check the validity of the response with Google ReCaptcha API
     *
     * @param string $response
     * @return boolean
     */
    public function checkCaptcha (string $response)
    {
        $apiURL = "https://www.google.com/recaptcha/api/siteverify?secret="
        . env('RECAPTCHA_SECRET')
        . "&response=" . $response
        . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
        
        $result = json_decode(file_get_contents($apiURL), true);

        return $result['success'];
    }
}