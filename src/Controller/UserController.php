<?php

namespace App\Controller;


use App\Entity\Busr;
use App\Form\BusrType;
use App\Repository\BusrRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{

    /**
     * @Route("/management", name="management")
     */
    public function index( BusrRepository $em, PaginatorInterface $paginator , Request $request)
    {


        //$query = $em->findAll();
        //Change result $query = table type to $query = Query type
        $query = $em->createQueryBuilder('s')->orderBy('s.id')->getQuery();
        $users = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users'=> $users

        ]);

    }

    /**
     * @Route("/new", name="user_new")
     * @Route("/user/{id}/edit", name="user_edit")
     */
    public function create(Busr $user =null, Request $request, ObjectManager $manager ){

        if(!$user){
            $user =new Busr();// Object needed in New User
        }



        $form = $this->createForm(BusrType::class , $user);
        $form->handleRequest($request);


        if ($form->isSubmitted()&& $form->isValid()){
            if (!$user->getId()){

                $user ->setDate(new \DateTime());
            }
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
             'info',
             "Success Operation"
            );
            return $this->redirectToRoute('management');


        }
        //New User
        return $this->render('user/new.html.twig',[
            'formUser' => $form->createView(),
            'editMode' => $user->getId() !==null
            // si user est null alors nous somme dans la mode new user
            //sinon nous sommes dans la mode edit article

        ]);


    }

    /**
     * @Route("/user/{id}/delete", name="user_delete")
     */
    public function deleteAction(Busr $user , ObjectManager $manager , Request $request,  $id)
    {
        $user = new Busr();
        $user = $manager->getRepository(Busr::class)->find($id);
        $manager->remove($user);
        $manager->flush();
        $this->addFlash(
            'delete',
            "The fields you chose have been removed"
        );


        return $this->redirectToRoute('management');
    }

}
