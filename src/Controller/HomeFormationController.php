<?php


namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeFormationController extends AbstractController
{
    #[Route('/home/formation', name: 'app_home_formation')]
    public function index(FormationRepository $formationRepository): Response
    {
        // Récupérer toutes les formations
        $formations = $formationRepository->findAll();

        return $this->render('home_formation/index.html.twig', [
            'formations' => $formations, // Passer les formations à la vue
        ]);
    }
    
          // Exemple de contrôleur pour gérer l'inscription à une formation
    #[Route('/formation/participer/{id}', name: 'app_participer_formation')]
    public function participer(int $id, FormationRepository $formationRepository): Response
    {
        // Récupération de la formation par son ID
        $formation = $formationRepository->find($id);
    
        if (!$formation) {
            throw $this->createNotFoundException('Formation non trouvée.');
        }

        // Logique pour gérer la participation (ex. ajouter un utilisateur à la formation)
        // Par exemple, vous pouvez ajouter un utilisateur connecté à cette formation.

        // Message de succès
        $this->addFlash('success', 'Vous avez bien participé à la formation ' . $formation->getNom());

        // Redirection vers une page de confirmation ou vers la liste des formations
        return $this->redirectToRoute('app_home_formation');
    }
}

