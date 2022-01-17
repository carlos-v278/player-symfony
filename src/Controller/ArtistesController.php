<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Artist;
use App\Repository\ArtistRepository;

class ArtistesController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function index(Request $request, ArtistRepository $artistRepository): Response
    {
        $artists= $artistRepository->findAll();
        $currentPage = $request->getPathInfo();
        return $this->render('artistes/index.html.twig', [
            'currentPage' => $currentPage,
            'artists'=> $artists,
        ]);
    }
    /**
     * @Route("/artiste/{id}", name="view_artist")
     */
    public function viewArtiste($id, ArtistRepository $artistRepository,Request $request): Response
    {
        $artist = $artistRepository->find($id);
        return $this->render('artistes/view.html.twig', [
            'currentPage' => '',
            'artist'=> $artist,
        ]);
    }
}
