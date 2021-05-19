<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/user/list/all", name="user_all")
     */
    public function index(): Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $userList = $userRepository->findAll();
        $users   = $this->formatToArray($userList);
        return $this->json(['users' => $users]);
    }

    /**
     * @Route("/user/list/clients", name="user_clients")
     */
    public function getClients(): Response
    {
        $users   = $this->getUsersFindBy('role', 3);
        return $this->json(['users' => $users]);
    }

    /**
     * @Route("/user/list/managers", name="user_managers")
     */
    public function getManagers(): Response
    {
        $users   = $this->getUsersFindBy('role', 2);
        return $this->json(['users' => $users]);
    }

    /**
     * @Route("/user/create", name="user_create")
     */
    public function create(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {

        $r = $request->query;
        $password   = password_hash($r->get('password'), PASSWORD_DEFAULT);
        $role       = $r->get('role');
        $showRoomId = $r->get('car_showroom_id');

        $user = new User();
        $user->setFio($r->get('fio'));
        $user->setEmail($r->get('email'));
        $user->setPhone($r->get('phone'));
        $user->setRole($role);
        $user->setPassword($password);
        $user->setCarShowroomId($showRoomId);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json([
            'user_id' => $user->getId(),
        ]);
    }

    /**
     * @Route("/user/one/{id}", name="user_by_id")
     */
    public function findUser($id) : Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($id);
        $user = $this->formatToArray([$user]);
        return $this->json(['user' => $user]);
    }

    /**
     * @param $userList
     * @return array
     */
    protected function formatToArray($userList): array
    {
        $data = [];
        foreach ($userList as $user) {
            $data[] = [
                'id'    => $user->getId(),
                'fio'   => $user->getFio(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'role'  => $user->getRole(),
                'show_room_id'  => $user->getCarShowRoomId(),
            ];
        }
        return $data;
    }

    /**
     * @param $field
     * @param $value
     * @return array
     */
    protected function getUsersFindBy($field, $value): array
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $userList = $userRepository->findBy([$field => $value]);
        $users   = $this->formatToArray($userList);
        return $users;
    }

}
