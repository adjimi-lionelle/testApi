<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CustomerController1 extends AbstractApiController
{
    /**
     * @Route("/api/customers", name="app_customer_index", methods={"GET"})
     */
    public function index(Request $request): Response 
    {
        
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();

        return $this->json($customers);
    }
    
    /**
     * @Route("/api/customers", name="app_customer_new", methods={"POST"})
     */
    public function newAction(Request $request, EntityManagerInterface $em, 
    NormalizerInterface $serializer, ValidatorInterface $validator): Response 
    {

        $jsonRecu = $request->getContent();
        $customer = $serializer->deserialize($jsonRecu, Customer::class, 'json');

        $errors = $validator->validate($customer);

        if(count($errors) >0)
        {
            return $this->json($errors, 400);
        }
        $em->persist($customer);
        $em->flush();

        return $this->json($customer, 201, []);
    }

    /**
     * @Route("/api/customers/{id}", name="app_customer_show", methods={"GET"})
     */
    public function showAction(Request $request, EntityManagerInterface $em): Response 
    {
        $customerId = $request->get('id');
        $customer = $em->getRepository(Customer::class)
        ->findById($customerId);
        //$customer = $repository->findOneById($customerId);
      

        return $this->json($customer, 201, []);
    }

    /**
     * @Route("/api/customers/delete/{id}", name="app_customer_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, CustomerRepository $repository,
    EntityManagerInterface $em ): Response 
    {
        $customerId = $request->get('id');
        $customer = $repository->findOneById($customerId);
        
        //dd($customer);die();
        $em->remove($customer);
        $em->flush();

        return $this->json('ok');
    }

     /**
     * @Route("/api/customers/edit/{id}", name="app_customer_edit", methods={"PUT"})
     */
    public function editAction(Customer $customer, Request $request, 
    EntityManagerInterface $em,NormalizerInterface $serializer ): Response 
    {
        

        $jsonRecu = $request->getContent();
        $serializer->deserialize($jsonRecu, Customer::class, 'json',
        [AbstractNormalizer::OBJECT_TO_POPULATE => $customer]
         
    );
        $em->flush();

        return $this->json($customer);
    }

    
   
}
