<?php
declare(strict_types=1);

namespace App\Entity;

//use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
  * @ORM\Table(name="app_product")
 * @ORM\Entity()
 */
class Product
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
     * @var string/null
     * 
     * @ORM\Column(name="code", type="string", length=100)
     * @Assert\NotBlank(message="le code est obligatoire")
     * @Assert\Length(max=2)
     */ 
    private $code;

    /**
     * @var string/null
     * 
     * @ORM\Column(name="title", type="string", length=100)
     * @Assert\NotBlank(message="le titre est obligatoire")
     */ 
    private $title;

    /**
     * @var int/null
     * 
     * @ORM\Column(name="price", type="integer", length=200)
     * @Assert\NotBlank(message="le prix est obligatoire")
     * @Assert\Length(max=5)
     */
    private $price;


    /**
     * @return int/null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string/null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string/null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;

    }

     /**
     * @return string/null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string/null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;

    }

    /**
     * @return int/null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return int/null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;

    }
}
