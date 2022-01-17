<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Music;
use App\Repository\MusicRepository;
class MusiquesController extends AbstractController
{
    /**
     * @Route("/musiques", name="musiques")
     */
    public function index(Request $request, MusicRepository $MusicRepository): Response
    {
        $musics = $MusicRepository->findAll();
        $currentPage = $request->getPathInfo();
        return $this->render('musiques/index.html.twig', [
            'currentPage' => $currentPage,
            'musics' => $musics,
        ]);
    }
}
