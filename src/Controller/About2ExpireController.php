<?php


namespace SimpleSAML\Modules\ExpiryCheckModule\Controller;


use Symfony\Component\HttpFoundation\Response;

final class About2ExpireController
{
    public function __invoke(): Response
    {
        return new Response(__CLASS__);
    }
}
