<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\ConfirmationFormType;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_")
     */
    // public function index(): Response
    // {
    //     return $this->render('user/index.html.twig', [
    //         'controller_name' => 'UserController',
    //     ]);
    // }

         /**
     * Liste des user
     * @Route("/user",name="user_list")
     */
    public function userList(UserRepository $userRepository)
    {
        return $this->render('user/user_list.html.twig',[
            'user_list' =>$userRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un user
     * @Route("/user/new",name="user_add")
     */
    public function userAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(UserFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $user=$form->getData();

            //Enregistrement en BDD
            $manager->persist($user);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouveau user a été enregistré.');
            // return $this->redirectToRoute('user_edit',['id'=>$user->getId()]);
            return $this->redirectToRoute('user_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('user/user_add.html.twig',[
            'user_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/user/{id}/edit", name="user_edit")
     */

    public function userEdit(User $user, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(UserFormType::class,$user);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $user->getEmail().' a été maj.');
            return $this->redirectToRoute('user_list');
            }

        return $this->render('user/user_edit.html.twig',[
            'user'=>$user,
            'user_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un user
     * @Route("/user/{id}/delete", name="user_delete")
     */

    public function userDelete(User $user, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($user);
            $manager->flush();
            $this->addFlash('success', 'le user '.$user->getEmail() .' a été supprimé.');
            return $this->redirectToRoute('user_list');
            
            }

        return $this->render('user/user_delete.html.twig',[
            'user'=>$user,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }

    


    
}
