<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $create_dt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $client_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $manager_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $car_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $car_showroom_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateDt(): ?string
    {
        return $this->create_dt;
    }

    public function setCreateDt(?string $create_dt): self
    {
        $this->create_dt = $create_dt;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    public function setClientId(?int $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getManagerId(): ?int
    {
        return $this->manager_id;
    }

    public function setManagerId(?int $manager_id): self
    {
        $this->manager_id = $manager_id;

        return $this;
    }

    public function getCarId(): ?int
    {
        return $this->car_id;
    }

    public function setCarId(?int $car_id): self
    {
        $this->car_id = $car_id;

        return $this;
    }

    public function getCarShowroomId(): ?int
    {
        return $this->car_showroom_id;
    }

    public function setCarShowroomId(?int $car_showroom_id): self
    {
        $this->car_showroom_id = $car_showroom_id;

        return $this;
    }
}
