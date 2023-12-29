<?php

namespace App\Controller;

use App\Entity\Host;
use App\Form\HostForm;
use App\Helpers\Alert;
use App\Repository\HostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends  BaseController
{
    private HostRepository $hostRepository;

    public function __construct(HostRepository $hostRepository)
    {
        $this->hostRepository = $hostRepository;
    }

    #[Route('/', name: 'root')]
    public function index() : Response {
        return $this->home();
    }

    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig', [
            'hosts' => $this->hostRepository->findAll()
        ]);
    }

    #[Route(['/delete/{host_id}'], name: 'delete_item')]
    public function delete(Request $request, EntityManagerInterface $entityManager, HostRepository $hostRepository, $host_id = 0) : Response {
        try {
            $host = $hostRepository->find($host_id);
            $entityManager->remove($host);
            $entityManager->flush();
            $this->addAlert(Alert::create('Host "' . $host->getName() . '" wurde gelöscht!', Alert::OK));
        } catch (\Exception $exception) {
            $this->addAlert(Alert::create('Host nicht gefunden.', Alert::ERROR));
        }
        return $this->home();
    }


    #[Route(['/add', '/edit/{host_id}'], name: 'add_item')]
    public function add(Request $request, EntityManagerInterface $entityManager, HostRepository $hostRepository, $host_id = 0): Response {
        $host = new Host();
        if ($host_id > 0) {
            $host = $hostRepository->find($host_id);
        }

        $form = $this->createForm(HostForm::class, $host);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $host = $form->getData();
            try {
                $entityManager->persist($host);
                $entityManager->flush();
                $this->addAlert(Alert::create('Host "' . $host->getName() . '" wurde gespeichert!', Alert::OK));
                return $this->home();
            } catch (\Exception $exception) {
                if (strpos($exception->getMessage(), 'UNIQUE constraint failed: host.ip') !== false) {
                    $this->addAlert(Alert::create('IP Adresse bereits vergeben!', Alert::ERROR));
                }
                else if (strpos($exception->getMessage(), 'UNIQUE constraint failed: host.mac') !== false) {
                    $this->addAlert(Alert::create('MAC Adresse bereits vergeben!', Alert::ERROR));
                }
                else if (strpos($exception->getMessage(), 'UNIQUE constraint failed: host.asset_id') !== false) {
                    $this->addAlert(Alert::create('Asset ID bereits vergeben!', Alert::ERROR));
                }
                else {
                    $this->addAlert(Alert::create($exception->getMessage(), Alert::ERROR));
                }
            }
        }

        return $this->render('home/add_item.html.twig', [
            'form' => $form,
            'edititem' => $host_id > 0,
            'host_id' => $host_id
        ]);
    }
}
