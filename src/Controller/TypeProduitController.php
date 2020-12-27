<?php

namespace App\Controller;

use App\Entity\TypeProduit;
use App\Repository\TypeProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ConfirmationFormType;
use App\Form\TypeProduitFormType;



class TypeProduitController extends AbstractController
{
    // /**
    //  * @Route("/type/produit", name="type_produit")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('type_produit/index.html.twig', [
    //         'controller_name' => 'TypeProduitController',
    //     ]);
    // }

    /**
     * Liste des type produits
     * @Route("/typeproduit",name="typeProduit_list")
     */

    public function typeProduitList(TypeProduitRepository $typeProduitRepository)
    {
        return $this->render('type_produit/typeProduit_list.html.twig',[
            'typeProduit_list' =>$typeProduitRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un typeProduit
     * @Route("/typeProduit/new",name="typeProduit_add")
     */
    public function typeProduitAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(TypeProduitFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $typeProduit=$form->getData();

            //Enregistrement en BDD
            $manager->persist($typeProduit);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouveau typeProduit a été enregistré.');
            // return $this->redirectToRoute('typeProduit_edit',['id'=>$typeProduit->getId()]);
            return $this->redirectToRoute('typeProduit_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('type_produit/typeProduit_add.html.twig',[
            'typeProduit_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/typeProduit/{id}/edit", name="typeProduit_edit")
     */

    public function typeProduitEdit(TypeProduit $typeProduit, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(TypeProduitFormType::class,$typeProduit);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $typeProduit->getName().' a été maj.');
            return $this->redirectToRoute('typeProduit_list');
            }

        return $this->render('type_produit/typeProduit_edit.html.twig',[
            'typeProduit'=>$typeProduit,
            'typeProduit_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un typeProduit
     * @Route("/typeProduit/{id}/delete", name="typeProduit_delete")
     */

    public function typeProduitDelete(TypeProduit $typeProduit, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($typeProduit);
            $manager->flush();
            $this->addFlash('success', 'le typeProduit '.$typeProduit->getName() .' a été supprimé.');
            return $this->redirectToRoute('typeProduit_list');
            
            }

        return $this->render('type_produit/typeProduit_delete.html.twig',[
            'typeProduit'=>$typeProduit,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }






}
