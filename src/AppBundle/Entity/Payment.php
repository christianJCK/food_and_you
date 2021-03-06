<?php

namespace AppBundle\Entity;

/**
 * Payment
 */
class Payment
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $productName;

    /**
     * @var string
     */
    private $status;

    /**
     * @var boolean
     */
    private $confirmationSent;

    /**
     * @var \AppBundle\Entity\BaptismHasUser
     */
    private $baptism_has_user;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Payment
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Payment
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return Payment
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set confirmationSent
     *
     * @param boolean $confirmationSent
     *
     * @return Payment
     */
    public function setConfirmationSent($confirmationSent)
    {
        $this->confirmationSent = $confirmationSent;

        return $this;
    }

    /**
     * Get confirmationSent
     *
     * @return boolean
     */
    public function getConfirmationSent()
    {
        return $this->confirmationSent;
    }

    /**
     * Set baptismHasUser
     *
     * @param \AppBundle\Entity\BaptismHasUser $baptismHasUser
     *
     * @return Payment
     */
    public function setBaptismHasUser(\AppBundle\Entity\BaptismHasUser $baptismHasUser = null)
    {
        $this->baptism_has_user = $baptismHasUser;

        return $this;
    }

    /**
     * Get baptismHasUser
     *
     * @return \AppBundle\Entity\BaptismHasUser
     */
    public function getBaptismHasUser()
    {
        return $this->baptism_has_user;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Payment
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \SogenactifBundle\Entity\Transaction
     */
    private $transaction;


    /**
     * Set transaction
     *
     * @param \SogenactifBundle\Entity\Transaction $transaction
     *
     * @return Payment
     */
    public function setTransaction(\SogenactifBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \SogenactifBundle\Entity\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}
