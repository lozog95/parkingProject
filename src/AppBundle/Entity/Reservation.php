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

use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="reservation")
 **/
class Reservation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * One Product has One Shipment.
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Slot")
     * @JoinColumn(name="slot_id", referencedColumnName="id")
     */
    private $slot;

    /**
     * One Product has One Shipment.
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="guest_id", referencedColumnName="id")
     */
    private $guest;

    /**
     * @ORM\Column(type="date", name="start")
     */
    private $start;
    /**
     * @ORM\Column(type="date", name="end")
     */
    private $end;

    /**
     * @return mixed
     */
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * @param mixed $owner
     */
    public function setSlot($slot)
    {
        $this->slot = $slot;
    }

    /**
     * @return mixed
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * @param mixed $guest
     */
    public function setGuest($guest)
    {
        $this->guest = $guest;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $from
     */
    public function setStart($from)
    {
        $this->start = $from;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $to
     */
    public function setEnd($to)
    {
        $this->end = $to;
    }


}