<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Repository\ArticleRepository;
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request,ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        $currentPage = $request->getPathInfo();
        return $this->render('blog/index.html.twig', [
            'currentPage' => $currentPage,
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/blog/{id}-{slug}", name="view_article")
     */
    public function viewArticle($id, ArticleRepository $articleRepository, Request $request,$slug): Response
    {
        $article = $articleRepository->find($id);
        if($article->getSlug() !== $slug) {
            return $this->redirectToRoute('view_article', [
                'id' => $id,
                'slug' => $article->getSlug()
            ]);
        }
        return $this->render('blog/view.html.twig', [
            'currentPage' => 'L',
            'article'=> $article,
        ]);
    }
}
