<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormulaireFormationType;
use App\Repository\FormationRepository;
use App\Repository\TypeFormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FormationController extends AbstractController
{
    // Afficher la liste des formations
    #[Route('/afficherformation', name: 'app_afficherformation')]
    public function afficher(FormationRepository $formationRep, TypeFormationRepository $typeFormationRepository): Response
    {
        // Récupérer toutes les formations
        $formations = $formationRep->findAll();
        $typeFormations = $typeFormationRepository->findAll();

        // Rendre la vue avec les formations
        return $this->render('formation/afficherformation.html.twig', [
            'formations' => $formations,
            'typeFormations' => $typeFormations,
        ]);
    }

    // Ajouter une nouvelle formation
    #[Route('/new', name: 'formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation(); // Crée une nouvelle entité Formation
        $form = $this->createForm(FormulaireFormationType::class, $formation); // Associe le formulaire à l'entité
        $form->handleRequest($request); // Gère la soumission du formulaire

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'image téléchargée
            $imageFile = $form->get('image')->getData();
            
            if ($imageFile) {
                // Gérer le nom du fichier (en le rendant unique)
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                try {
                    // Déplacez le fichier téléchargé dans le dossier public/uploads
                    $imageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    // Associez le nom du fichier à l'entité
                    $formation->setImage($newFilename);
                } catch (FileException $e) {
                    // Gérer l'exception si le téléchargement échoue
                    $this->addFlash('error', 'L\'image n\'a pas pu être téléchargée.');
                }
            }

            // Sauvegarder la formation dans la base de données
            $entityManager->persist($formation);
            $entityManager->flush(); // Enregistrer dans la base de données
            $this->addFlash('success', 'La formation a été enregistrée avec succès !');

            return $this->redirectToRoute('app_afficherformation'); // Rediriger vers la liste des formations
        }

        return $this->render('formation/new.html.twig', [
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
    }

    // Modifier une formation existante
    #[Route('/editer/{nom}', name: 'app_editerformation', methods: ['GET', 'POST'])]
    public function edit(string $nom, Request $request, FormationRepository $formationRepository, EntityManagerInterface $entityManager): Response
    {
        // Recherche de la formation à partir de son nom
        $formation = $formationRepository->findOneBy(['nom' => $nom]);

        if (!$formation) {
            throw $this->createNotFoundException('Formation non trouvée pour le nom : ' . $nom);
        }

        $form = $this->createForm(FormulaireFormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'image téléchargée (si présente)
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                try {
                    // Déplacer l'image dans le dossier d'uploads
                    $imageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    // Associer le nouveau fichier à la formation
                    $formation->setImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'L\'image n\'a pas pu être téléchargée.');
                }
            }

            // Sauvegarder les changements dans la base de données
            $entityManager->flush();
            $this->addFlash('success', 'Formation mise à jour avec succès !');
            return $this->redirectToRoute('app_afficherformation');
        }

        return $this->render('formation/editer.html.twig', [
            'form' => $form->createView(),
            'formation' => $formation,
        ]);
    }

    // Supprimer une formation
    #[Route('/delete/{nom}', name: 'formation_delete', methods: ['POST', 'GET'])]
    public function delete(Formation $formation, EntityManagerInterface $entityManager): Response
    {
        // Supprimer l'image si elle existe
        $imageFile = $formation->getImage();
        if ($imageFile) {
            $imagePath = $this->getParameter('uploads_directory') . '/' . $imageFile;
            if (file_exists($imagePath)) {
                unlink($imagePath); // Supprime le fichier image
            }
        }

        // Supprimer la formation de la base de données
        $entityManager->remove($formation);
        $entityManager->flush();

        $this->addFlash('success', 'La formation a été supprimée avec succès.');
        return $this->redirectToRoute('app_afficherformation');
    }
}
