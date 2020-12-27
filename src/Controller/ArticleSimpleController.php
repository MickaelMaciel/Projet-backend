<?php

namespace App\Controller;

use App\Entity\ArticleSimple;
use App\Form\ConfirmationFormType;
use App\Form\ArticleSimpleFormType;
use App\Repository\ArticleSimpleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleSimpleController extends AbstractController
{
   
    /**
     * Liste des articleSimple
     * @Route("/articleSimple",name="articleSimple_list")
     */
    public function articleSimpleList(ArticleSimpleRepository $articleSimpleRepository)
    {
        return $this->render('article_simple/articleSimple_list.html.twig',[
            'articleSimple_list' =>$articleSimpleRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un articleSimple
     * @Route("/articleSimple/new",name="articleSimple_add")
     */
    public function articleSimpleAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(ArticleSimpleFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $articleSimple=$form->getData();

            //Enregistrement en BDD
            $manager->persist($articleSimple);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouvel article simple a été enregistré.');
            // return $this->redirectToRoute('articleSimple_edit',['id'=>$articleSimple->getId()]);
            return $this->redirectToRoute('articleSimple_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('article_simple/articleSimple_add.html.twig',[
            'articleSimple_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/articleSimple/{id}/edit", name="articleSimple_edit")
     */

    public function articleSimpleEdit(ArticleSimple $articleSimple, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ArticleSimpleFormType::class,$articleSimple);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $articleSimple->getArticleSimpleName().' a été maj.');
            return $this->redirectToRoute('articleSimple_list');
            }

        return $this->render('article_simple/articleSimple_edit.html.twig',[
            'articleSimple'=>$articleSimple,
            'articleSimple_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un articleSimple
     * @Route("/articleSimple/{id}/delete", name="articleSimple_delete")
     */

    public function articleSimpleDelete(ArticleSimple $articleSimple, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($articleSimple);
            $manager->flush();
            $this->addFlash('success', 'l\' article simple '.$articleSimple->getArticleSimpleName() .' a été supprimé.');
            return $this->redirectToRoute('articleSimple_list');
            
            }

        return $this->render('article_simple/articleSimple_delete.html.twig',[
            'articleSimple'=>$articleSimple,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }





}
