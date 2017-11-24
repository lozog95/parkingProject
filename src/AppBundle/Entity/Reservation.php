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
     * @OneToOne(targetEntity="AppBundle\Entity\Slot")
     * @JoinColumn(name="slot_id", referencedColumnName="id")
     */
    private $slot;

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="guest_id", referencedColumnName="id")
     */
    private $guest;

    /**
     * @ORM\Column(type="datetime", name="from")
     */
    private $from;
    /**
     * @ORM\Column(type="datetime", name="to")
     */
    private $to;

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
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }


}