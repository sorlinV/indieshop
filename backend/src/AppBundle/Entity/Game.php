<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{

    /**
    * @ORM\ManyToMany(targetEntity="Tag", inversedBy="games", cascade={"persist"})
    * @ORM\JoinTable(name="article_tags")
    */
    private $tags;

    /**
    * @ORM\ManyToMany(targetEntity="User", mappedBy="creations")
    */
    private $creators;

    /**
    * @ORM\ManyToMany(targetEntity="User", mappedBy="games")
    */
    private $buyer;

    /**
    * @ORM\OneToMany(targetEntity="Rate", mappedBy="game")
    */
    private $rates; 

    /**
    * @ORM\ManyToMany(targetEntity="Cart", inversedBy="games", cascade={"persist"})
    * @ORM\JoinTable(name="Cart_Game")
    */
    private $cart;

    /**
    * @ORM\OneToMany(targetEntity="Report", mappedBy="game")
    */
    private $reports;

    /**
    * @ORM\OneToMany(targetEntity="Img", mappedBy="game")
    */
    private $imgs;

    /**
    * @ORM\OneToMany(targetEntity="File", mappedBy="game")
    */
    private $files;
    
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="desciption", type="string", length=4096)
     */
    private $desciption;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


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
     * Set name
     *
     * @param string $name
     *
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set desciption
     *
     * @param string $desciption
     *
     * @return Game
     */
    public function setDesciption($desciption)
    {
        $this->desciption = $desciption;

        return $this;
    }

    /**
     * Get desciption
     *
     * @return string
     */
    public function getDesciption()
    {
        return $this->desciption;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Game
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->creators = new \Doctrine\Common\Collections\ArrayCollection();
        $this->buyer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cart = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reports = new \Doctrine\Common\Collections\ArrayCollection();
        $this->imgs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tag
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return Game
     */
    public function addTag(\AppBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \AppBundle\Entity\Tag $tag
     */
    public function removeTag(\AppBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Game
     */
    public function addCreator(\AppBundle\Entity\User $creator)
    {
        $this->creators[] = $creator;

        return $this;
    }

    /**
     * Remove creator
     *
     * @param \AppBundle\Entity\User $creator
     */
    public function removeCreator(\AppBundle\Entity\User $creator)
    {
        $this->creators->removeElement($creator);
    }

    /**
     * Get creators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreators()
    {
        return $this->creators;
    }

    /**
     * Add buyer
     *
     * @param \AppBundle\Entity\Game $buyer
     *
     * @return Game
     */
    public function addBuyer(\AppBundle\Entity\Game $buyer)
    {
        $this->buyer[] = $buyer;

        return $this;
    }

    /**
     * Remove buyer
     *
     * @param \AppBundle\Entity\Game $buyer
     */
    public function removeBuyer(\AppBundle\Entity\Game $buyer)
    {
        $this->buyer->removeElement($buyer);
    }

    /**
     * Get buyer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Add rate
     *
     * @param \AppBundle\Entity\Rate $rate
     *
     * @return Game
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
     * Add cart
     *
     * @param \AppBundle\Entity\Cart $cart
     *
     * @return Game
     */
    public function addCart(\AppBundle\Entity\Cart $cart)
    {
        $this->cart[] = $cart;

        return $this;
    }

    /**
     * Remove cart
     *
     * @param \AppBundle\Entity\Cart $cart
     */
    public function removeCart(\AppBundle\Entity\Cart $cart)
    {
        $this->cart->removeElement($cart);
    }

    /**
     * Get cart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Add report
     *
     * @param \AppBundle\Entity\Report $report
     *
     * @return Game
     */
    public function addReport(\AppBundle\Entity\Report $report)
    {
        $this->reports[] = $report;

        return $this;
    }

    /**
     * Remove report
     *
     * @param \AppBundle\Entity\Report $report
     */
    public function removeReport(\AppBundle\Entity\Report $report)
    {
        $this->reports->removeElement($report);
    }

    /**
     * Get reports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * Add img
     *
     * @param \AppBundle\Entity\Img $img
     *
     * @return Game
     */
    public function addImg(\AppBundle\Entity\Img $img)
    {
        $this->imgs[] = $img;

        return $this;
    }

    /**
     * Remove img
     *
     * @param \AppBundle\Entity\Img $img
     */
    public function removeImg(\AppBundle\Entity\Img $img)
    {
        $this->imgs->removeElement($img);
    }

    /**
     * Get imgs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImgs()
    {
        return $this->imgs;
    }

    /**
     * Add file
     *
     * @param \AppBundle\Entity\File $file
     *
     * @return Game
     */
    public function addFile(\AppBundle\Entity\File $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \AppBundle\Entity\File $file
     */
    public function removeFile(\AppBundle\Entity\File $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }
}
