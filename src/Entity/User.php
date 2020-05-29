<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="l'email que vous avez indiqué est déja utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Length(min=8,max=255 , minMessage="votre mot de passe doit faire minimum 8 caractères ")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email(message = "votre email n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
     
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Country
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=IdeaProposition::class, mappedBy="user")
     */
    private $ideaPropositions;

    /**
     * @ORM\OneToMany(targetEntity=NoteHistory::class, mappedBy="user")
     */
    private $noteHistories;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="user")
     */
    private $messages;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\EqualTo(propertyPath="password",message="vous n'avez pas taper le meme mot de passe")
     */
    private $confirmPassword;

    

   

    public function __construct()
    {
        $this->ideaPropositions = new ArrayCollection();
        $this->noteHistories = new ArrayCollection();
        $this->messages = new ArrayCollection();
        
    
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|IdeaProposition[]
     */
    public function getIdeaPropositions(): Collection
    {
        return $this->ideaPropositions;
    }

    public function addIdeaProposition(IdeaProposition $ideaProposition): self
    {
        if (!$this->ideaPropositions->contains($ideaProposition)) {
            $this->ideaPropositions[] = $ideaProposition;
            $ideaProposition->setUser($this);
        }

        return $this;
    }

    public function removeIdeaProposition(IdeaProposition $ideaProposition): self
    {
        if ($this->ideaPropositions->contains($ideaProposition)) {
            $this->ideaPropositions->removeElement($ideaProposition);
            // set the owning side to null (unless already changed)
            if ($ideaProposition->getUser() === $this) {
                $ideaProposition->setUser(null);
            }
        }

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
            $noteHistory->setUser($this);
        }

        return $this;
    }

    public function removeNoteHistory(NoteHistory $noteHistory): self
    {
        if ($this->noteHistories->contains($noteHistory)) {
            $this->noteHistories->removeElement($noteHistory);
            // set the owning side to null (unless already changed)
            if ($noteHistory->getUser() === $this) {
                $noteHistory->setUser(null);
            }
        }

        return $this;
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
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
    public function __toString()
    {
        return $this->email;
    }

}