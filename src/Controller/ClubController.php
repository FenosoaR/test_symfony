<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use App\Repository\NationalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
    #[Route('/club/add', name:'add_club' , methods: ['GET', 'POST'])]
    public function add_club(Request $request , ClubRepository $clubRepository,NationalRepository $nationalRepository) : Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clubRepository->save($club);

            return $this->redirectToRoute('app_player');
        }

        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();

        return $this->renderForm('club/add.html.twig', [
            'club' => $club,
            'form' => $form,
            'clubs' => $clubs,
            'nationals' => $nationals,
        ]);
    }

    public function navComponent(ClubRepository $clubRepository , NationalRepository $nationalRepository): Response
{
    $clubs = $clubRepository->findAll();
    $national = $nationalRepository->findAll();
    return $this->render('components/nav.html.twig', [
        'clubs' => $clubs,
        'nationals'=> $national
    ]);
}
}
