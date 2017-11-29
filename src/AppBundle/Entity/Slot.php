<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 17.11.2017
 * Time: 21:16
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="slots")
 **/
class Slot
{
    /**
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\Column(name="is_released", type="boolean")
     */
    private $isReleased;

    /**
     * @ORM\Column(type="date", name="release_start", nullable=true)
     * @Assert\Date()
     */
    private $releaseStart;
    /**
     * @ORM\Column(type="date", name="release_end", nullable=true)
     * @Assert\Date()
     */
    private $releaseEnd;

    /**
     * @return mixed
     */
    public function getReleaseStart()
    {
        return $this->releaseStart;
    }

    /**
     * @param mixed $releaseStart
     */
    public function setReleaseStart($releaseStart)
    {
        $this->releaseStart = $releaseStart;
    }

    /**
     * @return mixed
     */
    public function getReleaseEnd()
    {
        return $this->releaseEnd;
    }

    /**
     * @param mixed $releaseEnd
     */
    public function setReleaseEnd($releaseEnd)
    {
        $this->releaseEnd = $releaseEnd;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner_id
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }
    public function getId(){
        return $this->id;
    }
    public function __construct()
    {
        $this->isReleased=false;
    }
    public function setReleaseStatus($status){
        $this->isReleased=$status;
    }


}