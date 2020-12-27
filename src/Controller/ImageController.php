<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ConfirmationFormType;
use App\Form\ImageFormType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
   
/**
     * Liste des image
     * @Route("/image",name="image_list")
     */
    public function imageList(ImageRepository $imageRepository)
    {
        return $this->render('image/image_list.html.twig',[
            'image_list' =>$imageRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un image
     * @Route("/image/new",name="image_add")
     */
    public function imageAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(ImageFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $image=$form->getData();

            //Enregistrement en BDD
            $manager->persist($image);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouveau image a été enregistré.');
            // return $this->redirectToRoute('image_edit',['id'=>$image->getId()]);
            return $this->redirectToRoute('image_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('image/image_add.html.twig',[
            'image_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/image/{id}/edit", name="image_edit")
     */

    public function imageEdit(Image $image, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ImageFormType::class,$image);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $image->getName().' a été maj.');
            return $this->redirectToRoute('image_list');
            }

        return $this->render('image/image_edit.html.twig',[
            'image'=>$image,
            'image_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un image
     * @Route("/image/{id}/delete", name="image_delete")
     */

    public function imageDelete(Image $image, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($image);
            $manager->flush();
            $this->addFlash('success', 'le image '.$image->getName() .' a été supprimé.');
            return $this->redirectToRoute('image_list');
            
            }

        return $this->render('image/image_delete.html.twig',[
            'image'=>$image,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }




}
