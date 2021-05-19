<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends BaseController
{

    /**
     * @Route("/order/list/all", name="order_all")
     */
    public function index(): Response
    {


        $repo = $this->getDoctrine()->getRepository(Order::class);
        $list = $repo->findAll();
        $results   = $this->formatToArray($list);
        return $this->json(['orders' => $results]);
    }

    /**
     * @Route("/order/create", name="order_create")
     */
    public function create(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {

        $r = $request->query;
        $showRoomId = $r->get('car_showroom_id');
        $date = date("Y-m-d H:i:s");

        $order = new Order();
        $order->setCreateDt($date);
        $order->setClientId($r->get('client_id'));
        $order->setManagerId($r->get('manager_id'));
        $order->setCarId($r->get('car_id'));
        $order->setCarShowroomId($showRoomId);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return $this->json([
            'order_id' => $order->getId(),
        ]);
    }

    /**
     * @Route("/order/list/by_client/{client_id}", name="order_by_client")
     */
    public function getOrderByClient($client_id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Order::class);
        $results = $repo->findByClientId($client_id);
        return $this->json(['orders' => $results]);
    }

    /**
     * @Route("/order/one/{id}", name="order_by_id")
     */
    public function findOrder($id) : Response
    {
        $repo = $this->getDoctrine()->getRepository(Order::class);
        $list = $repo->find($id);
        $results = $this->formatToArray([$list]);
        return $this->json(['order' => $results]);
    }

    /**
     * @param $userList
     * @return array
     */
    protected function formatToArray($list): array
    {
        $data = [];
        foreach ($list as $item) {
            $data[] = [
                'id'    => $item->getId(),
                'create_dt'   => $item->getCreateDt(),
                'client_id' => $item->getClientId(),
                'manager_id' => $item->getManagerId(),
                'car_id'  => $item->getCarId(),
                'car_showroom_id'  => $item->getCarShowroomId(),
            ];
        }
        return $data;
    }

    /**
     * @param $field
     * @param $value
     * @return array
     */
    protected function getOrdersFindBy($field, $value): array
    {
        $repo = $this->getDoctrine()->getRepository(Order::class);
        $list = $repo->findBy([$field => $value]);
        $results   = $this->formatToArray($list);
        return $results;
    }

}
