<?php

namespace QuentinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="discipline")
 */

class Discipline
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDiscipline;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Athlete", mappedBy="discipline", cascade={"remove"})
     */
    private $athlete;

    /**
     * @return mixed
     */
    public function getIdDiscipline()
    {
        return $this->idDiscipline;
    }

    /**
     * @param mixed $idDiscipline
     */
    public function setIdDiscipline($idDiscipline)
    {
        $this->idDiscipline = $idDiscipline;
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