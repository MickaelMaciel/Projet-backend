<?php

namespace App\Controller;

use App\Entity\ProduitConfigurable;
use App\Form\ConfirmationFormType;
use App\Form\ProduitConfigurableFormType;
use App\Repository\ProduitConfigurableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ProduitConfigurableController extends AbstractController
{
   
    /**
     * Liste des produitConfigurable
     * @Route("/produitConfigurable",name="produitConfigurable_list")
     */
    public function produitConfigurableList(ProduitConfigurableRepository $produitConfigurableRepository)
    {
        return $this->render('produit_configurable/produitConfigurable_list.html.twig',[
            'produitConfigurable_list' =>$produitConfigurableRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un produitConfigurable
     * @Route("/produitConfigurable/new",name="produitConfigurable_add")
     */
    public function produitConfigurableAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(ProduitConfigurableFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $produitConfigurable=$form->getData();

            //Enregistrement en BDD
            $manager->persist($produitConfigurable);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouveau produit configurable a été enregistré.');
            // return $this->redirectToRoute('produitConfigurable_edit',['id'=>$produitConfigurable->getId()]);
            return $this->redirectToRoute('produitConfigurable_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('produit_configurable/produitConfigurable_add.html.twig',[
            'produitConfigurable_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/produitConfigurable/{id}/edit", name="produitConfigurable_edit")
     */

    public function produitConfigurableEdit(ProduitConfigurable $produitConfigurable, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ProduitConfigurableFormType::class,$produitConfigurable);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $produitConfigurable->getName().' a été maj.');
            return $this->redirectToRoute('produitConfigurable_list');
            }

        return $this->render('produit_configurable/produitConfigurable_edit.html.twig',[
            'produitConfigurable'=>$produitConfigurable,
            'produitConfigurable_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un produitConfigurable
     * @Route("/produitConfigurable/{id}/delete", name="produitConfigurable_delete")
     */

    public function produitConfigurableDelete(ProduitConfigurable $produitConfigurable, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($produitConfigurable);
            $manager->flush();
            $this->addFlash('success', 'le produit configurable '.$produitConfigurable->getName() .' a été supprimé.');
            return $this->redirectToRoute('produitConfigurable_list');
            
            }

        return $this->render('produit_configurable/produitConfigurable_delete.html.twig',[
            'produitConfigurable'=>$produitConfigurable,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }



}
