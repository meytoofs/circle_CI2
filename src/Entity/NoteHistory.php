<?php

namespace App\Entity;

use App\Repository\NoteHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteHistoryRepository::class)
 */
class NoteHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="noteHistories")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=IdeaProposition::class, inversedBy="noteHistories")
     */
    private $ideaProposition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIdeaProposition(): ?IdeaProposition
    {
        return $this->ideaProposition;
    }

    public function setIdeaProposition(?IdeaProposition $ideaProposition): self
    {
        $this->ideaProposition = $ideaProposition;

        return $this;
    }
}
