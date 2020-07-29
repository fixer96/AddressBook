<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 *
 * @UniqueEntity(fields={"email"})
 * @UniqueEntity(fields={"phoneNumber"})
 */
class Contact
{
    /**
     * \Datetime $createdAt
     * \Datetime $updatedAt
     */
    use Timestampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=15, unique=true)
     *
     * @Assert\NotBlank()
     */
    private $phoneNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     *
     * @Assert\NotBlank()
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=100, nullable=true)
     */
    private $imageName;

    /**
     * @var Address
     *
     * @ORM\Embedded(class="AppBundle\Entity\Address")
     *
     * @Assert\Valid()
     */
    private $address;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Contact
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return Contact
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     *
     * @return Contact
     */
    public function setBirthday(\DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     *
     * @return Contact
     */
    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     *
     * @return Contact
     */
    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
