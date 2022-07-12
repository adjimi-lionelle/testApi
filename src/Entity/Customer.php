<?php
declare(strict_types=1);

namespace App\Entity;

//use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
  * @ORM\Table(name="app_customer")
 * @ORM\Entity()
 */
class Customer
{

    /**
     * @var int/null
     * 
     * @ORM\Column(name="id", type="integer", length=100)
      * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string/null
     * 
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\NotBlank(message="l'adresse email est obligatoire")
     * @Assert\Email(message = "L'email '{{ value }}' n'est pas valide.")
     */ 
    private $email;

    /**
     * @var string/null
     * 
     * @ORM\Column(name="phoneNumber", type="string")
     * @Assert\NotBlank(message="le numéro de téléphone est obligatoire")
     * @Assert\Length(max=13)

     */
    private $phoneNumber;


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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string/null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;

       
    }

    /**
     * @return string/null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string/null $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;

    }
}
