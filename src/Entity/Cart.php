<?php
declare(strict_types=1);

namespace App\Entity;

//use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
  * @ORM\Table(name="app_cart")
 * @ORM\Entity()
 */
class Cart
{

    /**
     * @var int/null
     * 
     * @ORM\Column(name="id", type="integer")
      * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime/null
     * 
     * @ORM\Column(name="date_time", type="datetime")
     * @Assert\NotBlank(message="la date est obligatoire")
     */ 
    private $dateTime;

    /**
     * @var Customer/null
     * 
     * @ORM\OneToOne(targetEntity="Customer")
     * @Assert\NotBlank(message="Client  est obligatoire")
     */ 
    private $customer;

    /**
     * @var Collection/Product[]
     * 
     * @ORM\ManyToMany(targetEntity="Customer",  cascade={"persist", "remove" })
     * @Assert\NotBlank(message="produits est obligatoire")
     */
    private $products;


    /**
     * @return int/null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return \DateTime/null
     * 
     */
    public function getDateTime(): ?\DateTime
    {
        return $this->$dateTime;
    }

    /**
     * @return string/null $dateTime
     */
    public function setDateTime(?\DateTime $dateTime): void
    {
        $this->dateTime = $dateTime;

    }

     /**
     * @return Customer/null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer/null $customer
     */
    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;

    }

    /**
     * @return Product[]/Collection
     */
    public function getProducts(): ?int
    {
        return $this->products;
    }

    /**
     * @param Product[]/Collection $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;

    }
}
