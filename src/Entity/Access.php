<?php

namespace App\Entity;

use App\Repository\AccessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessRepository::class)]
class Access
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'access_id', targetEntity: Userlist::class)]
    private Collection $userlists;

    public function __construct()
    {
        $this->userlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Userlist>
     */
    public function getUserlists(): Collection
    {
        return $this->userlists;
    }

    public function addUserlist(Userlist $userlist): self
    {
        if (!$this->userlists->contains($userlist)) {
            $this->userlists->add($userlist);
            $userlist->setAccessId($this);
        }

        return $this;
    }

    public function removeUserlist(Userlist $userlist): self
    {
        if ($this->userlists->removeElement($userlist)) {
            // set the owning side to null (unless already changed)
            if ($userlist->getAccessId() === $this) {
                $userlist->setAccessId(null);
            }
        }

        return $this;
    }
}
