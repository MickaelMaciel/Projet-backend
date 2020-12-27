<?php

// namespace App\Controller\Admin;
namespace App\Controller;

use App\Entity\Fabricant;
use App\Form\ConfirmationFormType;
use App\Form\FabricantFormType;
use App\Repository\FabricantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


 //@Route("/admin", name="admin_")
 

// class DashboardController extends AbstractController
class FabricantController extends AbstractController

{
   // /**
   //  * URL: /admin
   //  * nom: admin_dashboard
   //  * @Route("", name="dashboard")
   //  */
   // public function index(): Response
   // {
   //     return $this->render('admin/dashboard/index.html.twig');
   // }

    /**
     * Liste des fabricant
     * @Route("/fabricant",name="fabricant_list")
     */
    public function fabricantList(FabricantRepository $fabricantRepository)
    {
        return $this->render('fabricant/fabricant_list.html.twig',[
            'fabricant_list' =>$fabricantRepository->findAll(),
        ]);
    }

    /**
     * Ajouter un fabricant
     * @Route("/fabricant/new",name="fabricant_add")
     */
    public function fabricantAdd(Request $request, EntityManagerInterface $manager)
    {
        //1.Creer le formulaire

        $form=$this->createForm(FabricantFormType::class);

        //2. Passage de la requetes au formulaire (récupération des données POST et validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire est envoyer et valide
        if($form->isSubmitted() && $form->isValid()){

            //4.récuperer les données de formulaire
            $fabricant=$form->getData();

            //Enregistrement en BDD
            $manager->persist($fabricant);
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', 'le nouveau fabricant a été enregistré.');
            // return $this->redirectToRoute('fabricant_edit',['id'=>$fabricant->getId()]);
            return $this->redirectToRoute('fabricant_list');
        }

        //On envoie une vue de formulaire au template
        return $this->render('fabricant/fabricant_add.html.twig',[
            'fabricant_form' =>$form->createView()
        ]);
    }



    /**
     * Modification d'un artiste
     * @Route("/fabricant/{id}/edit", name="fabricant_edit")
     */

    public function fabricantEdit(Fabricant $fabricant, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(FabricantFormType::class,$fabricant);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

        
            // Pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            // Pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager

            //Enregistrement en BDD
            
            $manager->flush();

            //Ajout d'un message flash
            $this->addFlash('success', $fabricant->getName().' a été maj.');
            return $this->redirectToRoute('fabricant_list');
            }

        return $this->render('fabricant/fabricant_edit.html.twig',[
            'fabricant'=>$fabricant,
            'fabricant_form'=>$form->createView(),
            ]);
        

    }

      /**
     * Suppression d'un fabricant
     * @Route("/fabricant/{id}/delete", name="fabricant_delete")
     */

    public function fabricantDelete(Fabricant $fabricant, Request $request, EntityManagerInterface $manager)
    {
        $form=$this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);

           //3. Vérifier si le formulaire est envoyer et valide
           if($form->isSubmitted() && $form->isValid()){

            $manager->remove($fabricant);
            $manager->flush();
            $this->addFlash('success', 'le fabricant '.$fabricant->getName() .' a été supprimé.');
            return $this->redirectToRoute('fabricant_list');
            
            }

        return $this->render('fabricant/fabricant_delete.html.twig',[
            'fabricant'=>$fabricant,
            'confirmation_form'=>$form->createView(),
            ]);
        

    }

    

}
