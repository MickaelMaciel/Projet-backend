<?php

namespace App\Controller;

use App\Entity\VariationCouleur;
use App\Form\ConfirmationFormType;
use App\Form\VariationCouleurFormType;
use App\Repository\VariationCouleurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VariationCouleurController extends AbstractController
{
  
    /**
     * Liste des variationCouleur
     * @Route("/variationCouleur",name="variationCouleur_list")
     */
    public function variationCouleurList(VariationCouleurRepository $variationCouleurRepository)
    {
        return $this->render('variation_couleur/variationCouleur_list.html.twig',[
            'variationCouleur_list' =>$variationCouleurRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un variationCouleur
     * @Route("/variationCouleur/new",name="variationCouleur_add")
     */
    public function variationCouleurAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(VariationCouleurFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $variationCouleur=$form->getData();

            //Enregistrement en BDD
            $manager->persist($variationCouleur);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'la nouvelle couleur a été enregistrée.');
            // return $this->redirectToRoute('variationCouleur_edit',['id'=>$variationCouleur->getId()]);
            return $this->redirectToRoute('variationCouleur_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('variation_couleur/variationCouleur_add.html.twig',[
            'variationCouleur_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/variationCouleur/{id}/edit", name="variationCouleur_edit")
     */

    public function variationCouleurEdit(VariationCouleur $variationCouleur, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(VariationCouleurFormType::class,$variationCouleur);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $variationCouleur->getVariationCouleurName().' a été maj.');
            return $this->redirectToRoute('variationCouleur_list');
            }

        return $this->render('variation_couleur/variationCouleur_edit.html.twig',[
            'variationCouleur'=>$variationCouleur,
            'variationCouleur_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un variationCouleur
     * @Route("/variationCouleur/{id}/delete", name="variationCouleur_delete")
     */

    public function variationCouleurDelete(VariationCouleur $variationCouleur, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($variationCouleur);
            $manager->flush();
            $this->addFlash('success', 'la couleur '.$variationCouleur->getVariationCouleurName() .' a été supprimée.');
            return $this->redirectToRoute('variationCouleur_list');
            
            }

        return $this->render('variation_couleur/variationCouleur_delete.html.twig',[
            'variationCouleur'=>$variationCouleur,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }






}
