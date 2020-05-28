<?php

namespace App\Entity;

use App\Entity\Message;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoomRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"room:Message"}})
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("room:Message")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("room:Message")
     */
    public $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("room:Message")
     */
    private $type;

    /**
     * @var \DateTime $creationDate
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $creationDate;


    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="room")
     * @Groups("room:Message")
     */
    private $messages;

    /**
     * @ORM\OneToOne(targetEntity=IdeaProposition::class, cascade={"persist", "remove"})
     */
    private $ideaProposition;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    
    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setRoom($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getRoom() === $this) {
                $message->setRoom(null);
            }
        }

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
    public function __toString()
    {
        return $this->title;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }
    
}
