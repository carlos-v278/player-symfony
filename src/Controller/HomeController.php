<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
use App\Repository\ArtistRepository;
use App\Repository\AlbumRepository;
use App\Repository\MusicRepository;
class HomeController extends AbstractController
{
     /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('home');
    }
    /**
     * @Route("/home", name="home")
     */
    public function home( ArticleRepository $articleRepository, Request $request,ArtistRepository $artistRepository,AlbumRepository $albumRepository,  MusicRepository $MusicRepository): Response
    {
        $articles = $articleRepository->findBy(array(),array('id'=>'DESC'),2,0);
        $artists= $artistRepository->findBy(array(),array('id'=>'DESC'),5,0);
        $albums = $albumRepository->findBy(array(),array('id'=>'DESC'),6,0);
        $musics = $MusicRepository->findBy(array(),array('id'=>'DESC'),5,0);
        $currentPage = $request->getPathInfo();
        return $this->render('home/index.html.twig', [
            'currentPage' => $currentPage,
            'albums'=>$albums,
            'articles'=>$articles,
            'artists'=>$artists,
            'musics'=>$musics,
        ]);
    }
}

