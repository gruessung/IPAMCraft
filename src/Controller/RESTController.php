<?php

namespace App\Controller;

use App\Repository\HostRepository;
use JJG\Ping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RESTController extends AbstractController
{
    #[Route('/api/ping/{host_id}', name: 'api_ping')]
    public function index(HostRepository $hostRepository, int $host_id): Response
    {
        $host = $hostRepository->find($host_id);

        $ping = new Ping($host->getIp());
        $latency = $ping->ping();
        if ($latency !== false) {
            return $this->json(['reachable' => true, 'ip' => $host->getIp(), 'host_id' => $host->getId(), 'latency' => $latency]);
        }
        else {
            return $this->json(['reachable' => false, 'ip' => $host->getIp(), 'host_id' => $host->getId(), 'latency' => false]);
        }
    }
}
