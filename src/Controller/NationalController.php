<?php

namespace App\Controller;

use App\Entity\National;
use App\Form\NationalType;
use App\Repository\NationalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NationalController extends AbstractController
{
    #[Route('/national', name: 'app_national')]
    public function index(): Response
    {
        return $this->render('national/index.html.twig', [
            'controller_name' => 'NationalController',
        ]);
    }
    #[Route('/national/add', name:'add_national' , methods: ['GET', 'POST'])]
    public function add_club(Request $request , NationalRepository $nationalRepository) : Response
    {
        $national = new National();
        $form = $this->createForm(NationalType::class, $national);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nationalRepository->save($national);

            return $this->redirectToRoute('app_player', []);
        }

        return $this->renderForm('national/add.html.twig', [
            'national' => $national,
            'form' => $form,
        ]);
    }
}
