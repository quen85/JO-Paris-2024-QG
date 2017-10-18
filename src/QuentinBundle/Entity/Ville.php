<?php

namespace QuentinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="ville")
 */

class Ville
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idVille;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="form_notblank")
     */
    private $name;

    /**
     * @return mixed
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * @param mixed $idVille
     */
    public function setIdVille($idVille)
    {
        $this->idVille = $idVille;
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

    
}