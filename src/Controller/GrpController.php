<?php

namespace App\Controller;

use App\Entity\Agrp;
use App\Form\AgrpType;
use App\Repository\AgrpRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GrpController extends AbstractController
{
    /**
     * @Route("/group", name="group")
     */
    public function index(AgrpRepository $em,PaginatorInterface $paginator, Request $request)
    {
        //$query = $em->findAll();
        //Change result $query = table type to $query = Query type
        $query = $em->createQueryBuilder('s')->orderBy('s.id')->getQuery();
        $grps = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('grp/index.html.twig', [
            'controller_name' => 'GrpController',
            'grps'=> $grps
        ]);
    }

    /**
     * @Route("/group/new", name="group_new")
     * @Route("/group/{id}/edit", name="group_edit")
     */
    public function create(Agrp $grp =null, Request $request, ObjectManager $manager ){

        if(!$grp){
            $grp =new Agrp();// Object needed in New User
        }



        $form = $this->createForm(AgrpType::class , $grp);
        $form->handleRequest($request);


        if ($form->isSubmitted()&& $form->isValid()){
            $manager->persist($grp);
            $manager->flush();
            $this->addFlash(
                'info-group',
                "Success Operation"
            );
            return $this->redirectToRoute('group');


        }
        //New User
        return $this->render('grp/new.html.twig',[
            'formGrp' => $form->createView(),
            'editMode' => $grp->getId() !==null
            // si user est null alors nous somme dans la mode new user
            //sinon nous sommes dans la mode edit article

        ]);


    }

}
