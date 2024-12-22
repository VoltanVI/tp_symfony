<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function dashboard(): Response
    {
        // Vérifier si l'utilisateur est authentifié et a le rôle ROLE_ADMIN
        if (!$this->isGranted('ROLE_ADMIN')) {
            // Si l'utilisateur n'a pas le rôle, lancer une exception ou rediriger
            throw new AccessDeniedException('Accès refusé, vous devez être un administrateur pour voir cette page.');
        }

        // Ici, tu peux récupérer des données spécifiques à l'admin
        // Par exemple, des statistiques, des logs ou des informations de gestion
        return $this->render('admin/dashboard.html.twig', [
            'admin_email' => $this->getUser()->getUserIdentifier(),
            // Ajouter d'autres données spécifiques à l'admin ici
        ]);
    }
}
