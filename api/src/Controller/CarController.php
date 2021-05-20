<?php

namespace App\Controller;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends BaseController
{
    /**
     * @Route("/car/list/all", name="car_all")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Car::class);
        $cars = $repo->findAll();
        $cars   = $this->formatToArray($cars);
        return $this->json(['cars' => $cars]);
    }

    /**
     * @Route("/car/list/showroom/{roomId}", name="car_list_showroom_id", methods={"GET"})
     */
    public function getCarShowRoom($roomId): Response
    {
        $results = $this->getCarsFindBy('car_showroom_id', $roomId);
        return $this->json(['cars' => $results]);
    }

    /**
     * @Route("/car/create", name="car_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {

        $r = $request->query;

        $showRoomId = $r->get('car_showroom_id');

        $car = new Car();
        $car->setModel($r->get('model'));
        $car->setBrand($r->get('brand'));
        $car->setPrice($r->get('price'));
        $car->setCarShowroomId($showRoomId);

        $em = $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();

        return $this->json([
            'car_id' => $car->getId(),
        ]);
    }

    /**
     * @Route("/car/one/{id}", name="car")
     */
    public function getCar($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Car::class);
        $item = $repo->find($id);
        $item = $this->formatToArray([$item]);
        return $this->json([ 'car' => $item[0] ]);
    }

    protected function formatToArray($items) {
        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'id'    => $item->getId(),
                'model' => $item->getModel(),
                'brand' => $item->getBrand(),
                'price' => $item->getPrice(),
                'show_room_id'  => $item->getCarShowRoomId(),
            ];
        }
        return $data;
    }

    protected function getCarsFindBy($field, $value) {
        $repo  = $this->getDoctrine()->getRepository(Car::class);
        $items = $repo->findBy([$field => $value]);
        $results   = $this->formatToArray($items);
        return $results;
    }

}
