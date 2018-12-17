<?php

namespace App\Controller;


use App\Entity\Caracter;
use App\Entity\Power;
use App\Form\CaracterType;
use App\Form\PowerType;
use App\Repository\CaracterRepository;
use App\Repository\PowerRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller
 *
 * @Security("is_granted('ROLE_USER')")
 */
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
     * @Route("/", name="dashboard")
     */
    public function dashboardAction(CaracterRepository $caractersRepository, PowerRepository $powersRepository)
    {
        $caractersList = $caractersRepository->findBy([], ['id' => 'desc'], 8, 0);
        $powersList = $powersRepository->findAll();

        return $this->render('pages/dashboard.html.twig', [
            'caractersList' => $caractersList,
            'powersList' => $powersList
        ]);
    }

    /**
     * @Route("marvel/caracters", name="caracters")
     */
    public function showAllCaracters(CaracterRepository $caractersRepository)
    {
        $allCaracters = $caractersRepository->findAll();

        return $this->render('pages/allcaracters.html.twig', [
            'allCaracters' => $allCaracters
        ]);
    }

    /**
     * @Route("marvel/caracterShow/{id}", name="caracter.show")
     */
    public function showCaracterAction(Caracter $caracter)
    {

        return $this->render('pages/caracterShow.html.twig', [
            'caracter' => $caracter
        ]);
    }

    /**
     * @Route("marvel/newCaracter", name="caracter.new")
     * @param Caracter $caracter
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $caracter = new Caracter();
        $form = $this->createForm(CaracterType::class, $caracter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    /**
     * @Route("marvel/newPower", name="power.new")
     * @param Request $request
     * @param Power $power
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createPowerAction(Request $request)
    {
        $power = new Power();
        $form = $this->createForm(PowerType::class, $power);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($power);
            $this->em->flush();
            $this->addFlash('success', 'Ton pouvoir a bien été ajouté !');
            return $this->redirectToRoute('dashboard');
        }
        return $this->render('pages/newPower.html.twig', [
            'power' => $power,
            'form' => $form->createView()
        ]);
    }
}