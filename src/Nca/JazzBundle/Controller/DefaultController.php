<?php

namespace Nca\JazzBundle\Controller;

use Nca\JazzBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NcaJazzBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar héhé');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('Produit créé avec id '.$product->getId());
    }
    
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('NcaJazzBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé avec id '.$id);
        }

        return $this->render('NcaJazzBundle:Product:product.html.twig', array('product' => $product));
    }
    
    public function showAllAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('NcaJazzBundle:Product')->findAllOrderedByName();
        return $this->render('NcaJazzBundle:Product:products.html.twig', array('products' => $products));
    }

}
