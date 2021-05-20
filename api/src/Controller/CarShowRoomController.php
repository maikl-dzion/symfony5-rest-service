<?php

namespace App\Controller;

use App\Entity\CarShowRoom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarShowRoomController extends BaseController
{
    /**
     * @Route("/showroom/list/all", name="showroom_all")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(CarShowRoom::class);
        $list = $repo->findAll();
        $results   = $this->formatToArray($list);
        return $this->json(['list' => $results]);
    }

    /**
     * @Route("/showroom/one/{id}", name="showroom_one")
     */
    public function getCarShowRoom($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(CarShowRoom::class);
        $item = $repo->find($id);
        $item = $this->formatToArray([$item]);
        return $this->json([ 'item' => $item[0] ]);
    }

    protected function formatToArray($items) {
        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'id'      => $item->getId(),
                'address' => $item->getAddress(),
                'title'   => $item->getTitle(),
            ];
        }
        return $data;
    }

}
