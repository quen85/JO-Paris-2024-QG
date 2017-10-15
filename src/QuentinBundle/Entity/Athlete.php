<?php

namespace QuentinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="athlete")
 */

class Athlete
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAthlete;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $firstname;

    /**
     * @ORM\Column(type="date", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="form_notblank")
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="Pays", inversedBy="athlete", cascade={"detach"})
     * @ORM\JoinColumn(name="idPays", referencedColumnName="id_pays", onDelete="SET NULL")
     * @Assert\NotBlank(message="form_notblank")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity="Discipline", inversedBy="athlete")
     * @ORM\JoinColumn(name="idDiscipline", referencedColumnName="id_discipline")
     * @Assert\NotBlank(message="form_notblank")
     */
    private $discipline;

    /**
     * @return mixed
     */
    public function getIdAthlete()
    {
        return $this->idAthlete;
    }

    /**
     * @param mixed $idAthlete
     */
    public function setIdAthlete($idAthlete)
    {
        $this->idAthlete = $idAthlete;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return mixed
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param mixed $discipline
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
    }
}