<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\ClubRepository;
use App\Repository\NationalRepository;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player')]
    public function index(PlayerRepository $playerRepository, ClubRepository $clubRepository, NationalRepository $nationalRepository): Response

    {
        $players = $playerRepository->findAll();
        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();


        return $this->render('player/index.html.twig', [
            'players' => $players,
            'clubs' => $clubs,
            'nationals' => $nationals,
        ]);
    }


    #[Route('/player/add', name: 'add_player', methods: ['GET', 'POST'])]
    public function add_club(Request $request, PlayerRepository $playerRepository, ClubRepository $clubRepository, NationalRepository $nationalRepository): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playerRepository->save($player);

            return $this->redirectToRoute('app_player', []);
        }

        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();

        return $this->renderForm('player/add.html.twig', [
            'player' => $player,
            'form' => $form,
            'clubs' => $clubs,
            'nationals' => $nationals,
        ]);
    }


    #[Route('/player/{id}', name: 'delete_player')]
    public function delete(int $id, PlayerRepository $playerRepository): RedirectResponse
    {
        $player = $playerRepository->find($id);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($player);
        $entityManager->flush();

        return $this->redirectToRoute('app_player');
    }


    #[Route('/player/edit/{id}', name: 'edit_player',  methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, PlayerRepository $playerRepository, ClubRepository $clubRepository, NationalRepository $nationalRepository): Response
    {
        $player = $playerRepository->find($id);
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playerRepository->save($player, true);

            return $this->redirectToRoute('app_player');
        }
        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();


        return $this->renderForm('player/edit.html.twig', [
            'player' => $player,
            'form' => $form,
            'clubs' => $clubs,
            'nationals' => $nationals,
        ]);
    }


    #[Route("/view/{id}", name: "view_player")]
    public function view(int $id, PlayerRepository $playerRepository): JsonResponse
    {
        $player = $playerRepository->find($id);

        $data = [
            'id' => $player->getId(),
            'name' => $player->getNom(),
            'dateNaissance' => $player->getDateNaissance(),
            'nationalite' => $player->getNationalite(),
            'parcours' => $player->getParcours(),
            'nombreBut' => $player->getNombreBut(),
            'club' => $player->getClub()->getName(),
            'nationale' => $player->getNational()->getName(),
        ];
        return new JsonResponse($data);
    }

    #[Route('/player/club/{clubId}', name: 'player_by_club')]
    public function getByClub(PlayerRepository $playerRepository, int $clubId, ClubRepository $clubRepository, NationalRepository $nationalRepository): Response
    {
        $players = $playerRepository->findBy(['club' => $clubId]);
        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();

        $club = $clubRepository->findBy(['id' => $clubId]);
    
        return $this->render('player/index.html.twig', [
            'players' => $players,
            'clubs' => $clubs,
            'nationals' => $nationals,
            'club' => $club,

        ]);
    }

    #[Route('/player/national/{nationalId}', name: 'player_by_national')]
    public function getByNational(PlayerRepository $playerRepository, int $nationalId, ClubRepository $clubRepository, NationalRepository $nationalRepository): Response
    {

        $players = $playerRepository->findBy(['national' => $nationalId]);
        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();

        $national = $nationalRepository->findBy(['id' => $nationalId]);

        return $this->render('player/index.html.twig', [
            'players' => $players,
            'clubs' => $clubs,
            'nationals' => $nationals,
            'national' => $national
        ]);
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request, PlayerRepository $playerRepository, ClubRepository $clubRepository, NationalRepository $nationalRepository): Response
    {
        $keyWord = $request->query->get('q');
        $searchBy = $request->query->get('search_by');


        if ($searchBy === 'nombre_buts') {
            $players = $playerRepository->findAllLike($keyWord, 'nombreBut');
        } else if ($searchBy === 'parcours') {
            $players = $playerRepository->findAllLike($keyWord, 'parcours');
        } else {
            $players = $playerRepository->findAllLike($keyWord);
        }


        $clubs = $clubRepository->findAll();
        $nationals = $nationalRepository->findAll();

        return $this->render('player/search.html.twig', [
            'players' => $players,
            'clubs' => $clubs,
            'nationals' => $nationals,
        ]);
    }
}
