<?php
declare(strict_types=1);

namespace Shared\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/test")]
class TestController extends AbstractController
{
    public function __construct(
        protected ?Environment $twig = null,
    ) {}

    #[Route('', name: 'test_index')]
    #[Route('/{a}', name: 'test_index_2', requirements: ['a' => '\d+'])]
    public function index(Session $session, SerializerInterface $serializer, int $a = 0): Response
    {
        $opcacheCleared = false;
        if ($session->has('opcacheCleared')) {
            $opcacheCleared = (bool)$session->get('opcacheCleared');
            $session->set('opcacheCleared', false);
        }
        if (!$this->twig) {
            throw new NotFoundHttpException();
        }
        $obj = null;
    	return $this->render('test/index.html.twig', [
    	    'message' => 'OK',
            'opcacheCleared' => $opcacheCleared,
            'a' => $a,
            'json' => $obj ? $serializer->serialize($obj, 'json'): null,
        ]);
    }

    #[Route('/clear-opcache', name: 'test_clear_opcache')]
    public function clearOpcache(Session $session): RedirectResponse
    {
        if (!$this->twig) {

            //return new Response('OK');
            throw new NotFoundHttpException();
        }
        opcache_reset();

        $session->set('opcacheCleared', true);

        return $this->redirect($this->generateUrl('test_index'));
    }
}
