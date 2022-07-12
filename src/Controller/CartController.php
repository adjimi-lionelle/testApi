<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Cart;
use App\Form\CartType;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CartController extends AbstractController
{
   
    
    /**
     * @Route("/api/customer/cart", name="app_cart_new", methods={"POST"})
     */
    public function newAction(Request $request, EntityManagerInterface $em, 
    NormalizerInterface $serializer, ValidatorInterface $validator): Response 
    {

        $jsonRecu = $request->getContent();
        $carts = $serializer->deserialize($jsonRecu, Cart::class, 'json');

        $errors = $validator->validate($carts);

        if(count($errors) >0)
        {
            return $this->json($errors, 400);
        }
        $em->persist($carts);
        $em->flush();

        return $this->json($carts, 201, []);
    }

    /**
     * @Route("/api/products/{id}", name="app_product_show", methods={"GET"})
     */
    public function showAction(Request $request, EntityManagerInterface $em): Response 
    {
        $cartId = $request->get('id');
        $carts = $em->getRepository(Product::class)
        ->findById($cartId);
        //$customer = $repository->findOneById($customerId);
      

        return $this->json($cartIds, 201, []);
    }

    /**
     * @Route("/api/carts/delete/{id}", name="app_cart_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request,
    EntityManagerInterface $em ): Response 
    {
        $cartId = $request->get('id');
        $carts = $em->getRepository(Cart::class)->findOneById($cartId);
        
        //dd($customer);die();
        $em->remove($carts);
        $em->flush();

        return $this->json('ok');
    }

     /**
     * @Route("/api/carts/edit/{id}", name="app_cart_edit", methods={"PUT"})
     */
    public function editAction(Cart $carts, Request $request, 
    EntityManagerInterface $em,NormalizerInterface $serializer ): Response 
    {
        

        $jsonRecu = $request->getContent();
        $serializer->deserialize($jsonRecu, Cart::class, 'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $carts]
         
    );
        $em->flush();

        return $this->json($carts);
    }

    
   
}
