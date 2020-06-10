<?php

namespace App\Entity;

use App\Repository\IdeaPropositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=IdeaPropositionRepository::class)
 * @Vich\Uploadable
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
     *  @var \DateTime $creationDate
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * 
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

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $featuredImage;
    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featuredImage")
     * @var File
     */
    private $imageFile;

    

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
    public function getTotal()
    {
        $total = 0;
        foreach($this->getNoteHistories() as $history)
        {
            $total += $history->getScore();
        }
        return $total;
    }
    public function getAvg(){
        $total = count($this->getNoteHistories());
        if ($total == 0){
            return 0;
        }
        return $this->getTotal() / $total;
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

    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(string $featuredImage)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->date = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
    public function __toString()
    {
        return $this->title;
    }

    
}
