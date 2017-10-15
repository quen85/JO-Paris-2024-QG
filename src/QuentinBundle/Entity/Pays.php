<?php

namespace QuentinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="pays")
 */

class Pays
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPays;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $flag;

    /**
     * @ORM\OneToMany(targetEntity="Athlete", mappedBy="pays", orphanRemoval=true)
     */
    private $athlete;

    /**
     * @return mixed
     */
    public function getIdPays()
    {
        return $this->idPays;
    }

    /**
     * @param mixed $idPays
     */
    public function setIdPays($idPays)
    {
        $this->idPays = $idPays;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return mixed
     */
    public function getAthlete()
    {
        return $this->athlete;
    }

    /**
     * @param mixed $athlete
     */
    public function setAthlete($athlete)
    {
        $this->athlete = $athlete;
    }

}