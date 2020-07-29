<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable()
 */
class Address
{
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=10)
     *
     * @Assert\NotBlank()
     */
    private $zipCode;

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return Address
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return Address
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return Address
     */
    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
}
