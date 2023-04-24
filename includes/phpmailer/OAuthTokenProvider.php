<?php

namespace PHPMailer\PHPMailer;

interface OAuthTokenProvider
{
    /**
     *
     * @return string
     */
    public function getOauth64();
}
