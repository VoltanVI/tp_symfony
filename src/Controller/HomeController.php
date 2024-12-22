<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\CommentRepository;
use App\Repository\PlaylistRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(AlbumRepository $albumRepository, ArtistRepository $artistRepository, CommentRepository $commentRepository, PlaylistRepository $playlistRepository, UserRepository $userRepository): Response
    {
        $albums = $albumRepository->findAlbumsWithArtist();
        $playlist = $playlistRepository->findAll();
        $artist = $artistRepository->findAll();
        $comment = $commentRepository->findCommentsWithUser();
//        $user = $userRepository->findAll();

        return $this->render('./index.html.twig',[
            'albums' => $albums,
            'playlists' => $playlist,
            'artists' => $artist,
            'comments' => $comment,
//            'users' => $user
        ]);
    }
}
