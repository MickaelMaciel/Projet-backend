<?php

namespace App\Controller;

use App\Entity\SousTypeProduit;
use App\Entity\TypeProduit;
use App\Form\ConfirmationFormType;
use App\Form\SousTypeProduitFormType;
use App\Form\TypeProduitFormType;
use App\Repository\SousTypeProduitRepository;
use App\Repository\TypeProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\TypeProduit as EntityTypeProduit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SousTypeProduitController extends AbstractController
{
    
    /**
     * Liste des sousTypeProduit
     * @Route("/sousTypeProduit",name="sousTypeProduit_list")
     */
    public function sousTypeProduitList(SousTypeProduitRepository $sousTypeProduitRepository)
    {
        return $this->render('sous_type_produit/sousTypeProduit_list.html.twig',[
            'sousTypeProduit_list' =>$sousTypeProduitRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un sousTypeProduit
     * @Route("/sousTypeProduit/new",name="sousTypeProduit_add")
     */
    public function sousTypeProduitAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire
        $typeProduit=new TypeProduit();

        $form=$this->createForm(SousTypeProduitFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $sousTypeProduit=$form->getData();
          

            //Enregistrement en BDD
            $manager->persist($sousTypeProduit);
          
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouveau sous type produit a été enregistré.');
            // return $this->redirectToRoute('sousTypeProduit_edit',['id'=>$sousTypeProduit->getId()]);
            return $this->redirectToRoute('sousTypeProduit_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('sous_type_produit/sousTypeProduit_add.html.twig',[
            'sousTypeProduit_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/sousTypeProduit/{id}/edit", name="sousTypeProduit_edit")
     */

    public function sousTypeProduitEdit(SousTypeProduit $sousTypeProduit, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(SousTypeProduitFormType::class,$sousTypeProduit);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $sousTypeProduit->getName().' a été maj.');
            return $this->redirectToRoute('sousTypeProduit_list');
            }

        return $this->render('sous_typetproduit/sousTypeProduit_edit.html.twig',[
            'sousTypeProduit'=>$sousTypeProduit,
            'sousTypeProduit_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un sousTypeProduit
     * @Route("/sousTypeProduit/{id}/delete", name="sousTypeProduit_delete")
     */

    public function sousTypeProduitDelete(SousTypeProduit $sousTypeProduit, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($sousTypeProduit);
            $manager->flush();
            $this->addFlash('success', 'le sous type produit '.$sousTypeProduit->getName() .' a été supprimé.');
            return $this->redirectToRoute('sousTypeProduit_list');
            
            }

        return $this->render('sous_type_produit/sousTypeProduit_delete.html.twig',[
            'sousTypeProduit'=>$sousTypeProduit,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }


}
