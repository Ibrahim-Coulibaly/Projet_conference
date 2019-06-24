<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $started;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="games")
     */
    private $users;

    /**
     * @ORM\Column(type="integer")
     */
    private $Amount;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStarted(): ?\DateTimeInterface
    {
        return $this->started;
    }

    /**
     * @param \DateTimeInterface $started
     * @return Game
     */
    public function setStarted(\DateTimeInterface $started): self
    {
        $this->started = $started;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return Game
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    /**
     * @param User $user
     * @return Game
     */
    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    /**
     * @param int $Amount
     * @return Game
     */
    public function setAmount(int $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    /**
     * @return array
     */
    public function getCases(): array
    {
        $casesNumber = [32,15,19,4,21,2,25,17,34,6,27,13,36,11,30,8,
            23,10,5,24,16,33,1,20,14,31,9,22,18,29,7,28,12,35,3,26];

        $cases = [new CaseRoulette(0, 'Vert')];
        $isOdd = true;
        foreach ($casesNumber as $num) {
            $cases[] = new CaseRoulette($num, $isOdd ? 'Rouge' : 'Noir');
            $isOdd = !$isOdd;
        }

        return $cases;
    }

    public function __toString(): string
    {

        return $this->id;
    }
}
