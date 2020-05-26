<?php

namespace App\Entity;

use App\Repository\IdeaPropositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdeaPropositionRepository::class)
 */
class IdeaProposition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalScore;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ideaPropositions")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=NoteHistory::class, mappedBy="ideaProposition")
     */
    private $noteHistories;

    

    public function __construct()
    {
        $this->noteHistories = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTotalScore(): ?int
    {
        return $this->totalScore;
    }

    public function setTotalScore(int $totalScore): self
    {
        $this->totalScore = $totalScore;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    /**
     * @return Collection|NoteHistory[]
     */
    public function getNoteHistories(): Collection
    {
        return $this->noteHistories;
    }

    public function addNoteHistory(NoteHistory $noteHistory): self
    {
        if (!$this->noteHistories->contains($noteHistory)) {
            $this->noteHistories[] = $noteHistory;
            $noteHistory->setIdeaProposition($this);
        }

        return $this;
    }

    public function removeNoteHistory(NoteHistory $noteHistory): self
    {
        if ($this->noteHistories->contains($noteHistory)) {
            $this->noteHistories->removeElement($noteHistory);
            // set the owning side to null (unless already changed)
            if ($noteHistory->getIdeaProposition() === $this) {
                $noteHistory->setIdeaProposition(null);
            }
        }

        return $this;
    }

    
}
