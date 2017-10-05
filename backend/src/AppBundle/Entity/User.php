<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
    * @ORM\ManyToMany(targetEntity="Game", inversedBy="creators", cascade={"persist"})
    * @ORM\JoinTable(name="User_Game_Creator")
    */
    private $creations;

    /**
    * @ORM\ManyToMany(targetEntity="Game", inversedBy="buyer", cascade={"persist"})
    * @ORM\JoinTable(name="User_Game_Buy")
    */
    private $games;
    
    /**
    * @ORM\OneToMany(targetEntity="Rate", mappedBy="user")
    */
    private $rates;    

    /**
    * @ORM\OneToOne(targetEntity="Cart")
    * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
    */
    private $cart;

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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="grade", type="string", length=255)
     */
    private $grade;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set grade
     *
     * @param string $grade
     *
     * @return User
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add creation
     *
     * @param \AppBundle\Entity\Game $creation
     *
     * @return User
     */
    public function addCreation(\AppBundle\Entity\Game $creation)
    {
        $this->creations[] = $creation;

        return $this;
    }

    /**
     * Remove creation
     *
     * @param \AppBundle\Entity\Game $creation
     */
    public function removeCreation(\AppBundle\Entity\Game $creation)
    {
        $this->creations->removeElement($creation);
    }

    /**
     * Get creations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreations()
    {
        return $this->creations;
    }

    /**
     * Add game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return User
     */
    public function addGame(\AppBundle\Entity\Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \AppBundle\Entity\Game $game
     */
    public function removeGame(\AppBundle\Entity\Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * Add rate
     *
     * @param \AppBundle\Entity\Rate $rate
     *
     * @return User
     */
    public function addRate(\AppBundle\Entity\Rate $rate)
    {
        $this->rates[] = $rate;

        return $this;
    }

    /**
     * Remove rate
     *
     * @param \AppBundle\Entity\Rate $rate
     */
    public function removeRate(\AppBundle\Entity\Rate $rate)
    {
        $this->rates->removeElement($rate);
    }

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * Set cart
     *
     * @param \AppBundle\Entity\Cart $cart
     *
     * @return User
     */
    public function setCart(\AppBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \AppBundle\Entity\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}
