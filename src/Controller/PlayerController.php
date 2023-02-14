<?php
namespace App\Controller;


use App\Entity\Game;
use App\Entity\Player;
use App\FakeData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends AbstractController
{

    public function index(EntityManagerInterface $entityManager): Response
    {
        $players = $entityManager->getRepository(Player::class)->findAll();
        return $this->render("player/index", ["players" => $players]);
    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $player = new Player();

        if ($request->getMethod() == Request::METHOD_POST) {
            $player->setUsername($request->request->get("username"))
                   ->setEmail($request->request->get("email"));
            $entityManager->persist($player);
            $entityManager->flush();
            return $this->redirectTo("/player");
        }
        return $this->render("player/form", ["player" => $player]);
    }


    public function show($id, EntityManagerInterface $entityManager): Response
    {
        $player = $entityManager->getRepository(Player::class)->find($id);
        return $this->render("player/show", ["player" => $player, "availableGames" => FakeData::games()]);
    }


    public function edit($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $player = $entityManager->getRepository(Player::class)->find($id);

        if ($request->getMethod() == Request::METHOD_POST) {
            $player->setUsername($request->request->get("username"))
                   ->setEmail($request->request->get("email"));
            $entityManager->flush();
            return $this->redirectTo("/player");
        }
        return $this->render("player/form", ["player" => $player]);
    }

    public function delete($id, EntityManagerInterface $entityManager): Response
    {
        $player = $entityManager->getRepository(Player::class)->find($id);
        $entityManager->remove($player);
        $entityManager->flush();
        return $this->redirectTo("/player");
    }

    public function addGame($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $player = $entityManager->getRepository(Player::class)->find($id);
            $player->addGame(new Game());
            $entityManager->flush();
        }
        return $this->redirectTo("/player");
    }

}
