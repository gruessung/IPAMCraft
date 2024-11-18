<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\Host;
use App\Form\AssetFormType;
use App\Form\HostForm;
use App\Helpers\Alert;
use App\Repository\AssetRepository;
use App\Repository\HostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssetController extends BaseController
{
    private AssetRepository $assetRepository;

    public function __construct(AssetRepository $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    #[Route('/asset', name: 'app_asset')]
    public function index(): Response
    {
        $assets = $this->assetRepository->findAll();


        return $this->render('asset/index.html.twig', [
            'assets' => $assets
        ]);
    }


    #[Route(['/asset/add', '/asset/{asset_id}'], name: 'add_asset')]
    public function add(Request $request, EntityManagerInterface $entityManager, AssetRepository $assetRepository, $asset_id = 0): Response {
        $asset = new Asset();
        if ($asset_id > 0) {
            $asset = $assetRepository->find($asset_id);
        }

        $form = $this->createForm(AssetFormType::class, $asset);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $asset = $form->getData();
            try {
                $entityManager->persist($asset);
                $entityManager->flush();
                $this->addAlert(Alert::create('Asset "' . $asset->getLabelno() . '" wurde gespeichert!', Alert::OK));
                return $this->index();
            } catch (\Exception $exception) {
                $this->addAlert(Alert::create($exception->getMessage(), Alert::ERROR));
            }
        }

        return $this->render('host/add_item.html.twig', [
            'form' => $form,
            'edititem' => $asset_id > 0,
            'host_id' => $asset_id
        ]);
    }

}
