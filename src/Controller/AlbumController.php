<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Album;
use App\Repository\AlbumRepository;
class AlbumController extends AbstractController
{
    /**
     * @Route("/album", name="album")
     */
    public function index(Request $request,AlbumRepository $albumRepository): Response
    {
        $albums = $albumRepository->findAll();
        $currentPage = $request->getPathInfo();
        return $this->render('album/index.html.twig', [
            'currentPage' => $currentPage,
            'albums' => $albums,
        ]);
    }
    /**
     * @Route("/album/{id}-{slug}", name="view_album")
     */
    public function viewAlbum($id, Request $request, AlbumRepository $albumRepository, $slug): Response
    {
        $album = $albumRepository->find($id);
        if($album->getSlug() !== $slug) {
            return $this->redirectToRoute('view_album', [
                'id' => $id,
                'slug' => $album->getSlug()
            ]);
        }
        return $this->render('album/view.html.twig', [
            'currentPage' => 'FFFF',
            'album'=> $album,
        ]);
    }
}
