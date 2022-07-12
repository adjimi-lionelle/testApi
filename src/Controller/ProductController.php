<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/api/products", name="app_product_index", methods={"GET"})
     */
    public function indexAction(Request $request): Response 
    {
        
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->json($products);
    }
    
    /**
     * @Route("/api/products", name="app_product_new", methods={"POST"})
     */
    public function newAction(Request $request, EntityManagerInterface $em, 
    NormalizerInterface $serializer, ValidatorInterface $validator): Response 
    {

        $jsonRecu = $request->getContent();
        $products = $serializer->deserialize($jsonRecu, Product::class, 'json');

        $errors = $validator->validate($products);

        if(count($errors) >0)
        {
            return $this->json($errors, 400);
        }
        $em->persist($products);
        $em->flush();

        return $this->json($products, 201, []);
    }

    /**
     * @Route("/api/products/{id}", name="app_product_show", methods={"GET"})
     */
    public function showAction(Request $request, EntityManagerInterface $em): Response 
    {
        $customerId = $request->get('id');
        $products = $em->getRepository(Product::class)
        ->findById($customerId);
        //$customer = $repository->findOneById($customerId);
      

        return $this->json($products, 201, []);
    }

    /**
     * @Route("/api/products/delete/{id}", name="app_products_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, ProductRepository $repository,
    EntityManagerInterface $em ): Response 
    {
        $productId = $request->get('id');
        $products = $repository->findOneById($productId);
        
        //dd($customer);die();
        $em->remove($products);
        $em->flush();

        return $this->json('ok');
    }

     /**
     * @Route("/api/products/edit/{id}", name="app_product_edit", methods={"PUT"})
     */
    public function editAction(Product $products, Request $request, 
    EntityManagerInterface $em,NormalizerInterface $serializer ): Response 
    {
        

        $jsonRecu = $request->getContent();
        $serializer->deserialize($jsonRecu, Product::class, 'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $products]
         
    );
        $em->flush();

        return $this->json($products);
    }

    
   
}
