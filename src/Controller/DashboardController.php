<?php

namespace App\Controller;


use App\Entity\Caracters;
use App\Entity\Powers;
use App\Form\CaracterType;
use App\Repository\CaractersRepository;
use App\Repository\PowersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractController
{


    /**
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em)
    {

        $this->em = $em;
    }





    /**
     * @Route("login/marvel", name="dashboard")
     */
    public function dashboardAction(CaractersRepository $caractersRepository, PowersRepository $powersRepository)
    {

        $caractersList = $caractersRepository->findBy([], ['id' => 'desc'], 8, 0);
        $powersList = $powersRepository->findAll();

        return $this->render('pages/dashboard.html.twig', [
            'caractersList' =>$caractersList,
            'powersList' => $powersList
            ]);
    }


    /**
     * @Route("login/marvel/caracters", name="caracters")
     */
    public function showAllCaracters(CaractersRepository $caractersRepository)
    {
        $allCaracters = $caractersRepository->findAll();

        return $this->render('pages/allcaracters.html.twig', [
            'allCaracters' => $allCaracters
        ]);

    }


    /**
     * @Route("login/marvel/caracterShow/{id}", name="caracter.show")
     */
    public function showCaracterAction(Caracters $caracterList, Powers $powersList)
    {

        return $this->render('pages/caracterShow.html.twig', [
            'caracter' => $caracterList,
            'powersList' => $powersList
        ]);
    }


    /**
     * @Route("login/marvel/newCaracter", name="caracter.new")
     * @param Caracters $caracter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $caracter = new caracters();
        $form = $this->createForm(CaracterType::class, $caracter);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($caracter);
            $this->em->flush();
            $this->addFlash('success', 'Ton personage a bien été ajouté !');
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('pages/newCaracter.html.twig', [
            'caracter' => $caracter,
            'form' => $form->createView()
        ]);
    }
}