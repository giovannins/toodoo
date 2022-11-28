<?php

namespace App\Entity;

use App\Repository\UserlistRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::ARRAY)]
    private array $todolist = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

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

    public function getTodolist(): array
    {
        return $this->todolist;
    }

    public function setTodolist(array $todolist): self
    {
        $this->todolist = $todolist;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
