<?php

namespace App\Entity;

use App\Repository\UserlistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserlistRepository::class)]
class Userlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userlists')]
    private ?Access $access_id = null;

    #[ORM\Column(length: 255)]
    private ?string $todo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccessId(): ?Access
    {
        return $this->access_id;
    }

    public function setAccessId(?Access $access_id): self
    {
        $this->access_id = $access_id;

        return $this;
    }

    public function getTodo(): ?string
    {
        return $this->todo;
    }

    public function setTodo(string $todo): self
    {
        $this->todo = $todo;

        return $this;
    }
}
