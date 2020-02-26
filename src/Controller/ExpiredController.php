<?php


namespace SimpleSAML\Modules\ExpiryCheckModule\Controller;


use SimpleSAML\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExpiredController extends AbstractController
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function __invoke(Request $request): Response
    {
        \SimpleSAML\Logger::info('expirycheck - User has been warned that NetID is near to expirational date.');

        if (!$request->get('StateId')) {
            throw new \SimpleSAML\Error\BadRequest('Missing required StateId query parameter.');
        }


        /** @psalm-var array $state */
        $state = \SimpleSAML\Auth\State::loadState($_REQUEST['StateId'], 'expirywarning:expired');

        return $this->render('@ExpiryCheckModule/expired.html.twig', [
            'expireOnDate' => $state['expireOnDate'],
            'netId' => $state['netId'],
        ]);
    }
}
