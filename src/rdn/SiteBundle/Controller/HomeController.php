<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace rdn\SiteBundle\Controller;

use rdn\SiteBundle\Entity\Home;
use rdn\SiteBundle\Entity\Message;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// POST GET
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HomeController extends Controller
{

      public function addAction()
      // public function addAction(Request $request)
    {
      // On crée un objet Advert
      $home = new Home();

      // On crée le FormBuilder grâce au service form factory
      $formBuilder = $this->get('form.factory')->createBuilder('form', $home);

      // On ajoute les champs de l'entité que l'on veut à notre formulaire
      $formBuilder
        ->add('date',      'date')
        ->add('title',     'text')
        ->add('content',   'textarea')
        ->add('author',    'text')
        ->add('published', 'checkbox')
        ->add('save',      'submit')
      ;
      // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

      // À partir du formBuilder, on génère le formulaire
      $form = $formBuilder->getForm();

      // On passe la méthode createView() du formulaire à la vue
      // afin qu'elle puisse afficher le formulaire toute seule
      return $this->render('rdnSiteBundle:Home:add.html.twig', array(
        'form' => $form->createView(),
      ));
    }


    public function indexAction()
    {
      $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('rdnSiteBundle:Home')
      ;

      $recettesTop = $repository->findBy(
        array(), // Critere
        array(),        // Tri
        4,                              // Limite
        0                               // Offset
      );

      $recettesBottom = $repository->findBy(
        array(), // Critere
        array(),        // Tri
        4,                              // Limite
        4                               // Offset
      );

      // $recettes est donc une instance de OC\PlatformBundle\Entity\Advert
      // ou null si l'id $id  n'existe pas, d'où ce if :
      if (null === $recettesTop OR null === $recettesBottom ) {
        // A CHANGER >> ALLER VERS CONTOLLEUR ACCUEIL
        $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'oui'));
        return new Response($content);
      }

        $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array(
                                                                                'recettesTop' => $recettesTop,
                                                                                'recettesBottom' => $recettesBottom,
                                                                              ));
        return new Response($content);
    }


    public function recettesAction()
    {

      // On récupère le repository
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('rdnSiteBundle:Home')
        ;

        $recettes = $repository->findBy(
          array(), // Critere
          array('name' => 'ASC')        // Tri                             // Offset
        );

        // $recettes est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $recettes) {
          // A CHANGER >> ALLER VERS CONTOLLEUR ACCUEIL
          $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'oui'));
          return new Response($content);
        }

        $content = $this->renderView('rdnSiteBundle:Home:recettes.html.twig',array('recettes' => $recettes));

        return new Response($content);
    }


    public function recetteAction($id)
    {
      // On récupère le repository
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('rdnSiteBundle:Home')
        ;

        $recette = $repository->find($id);

        // $recette est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $recette) {

          // A CHANGER >> ALLER VERS CONTOLLEUR ACCUEIL
          $content = $this->renderView('rdnSiteBundle:Home:index.html.twig',array('nom' => 'oui'));
          return new Response($content);
        }

        $content = $this->renderView('rdnSiteBundle:Home:recette.html.twig',array('recette' => $recette));

        return new Response($content);
    }

    public function contactAction()
    {
      $message = new Message();

      $form = $this->createFormBuilder($message)
           ->setAction($this->generateUrl('add_message'))
           ->setMethod('POST')
           ->add('name', TextType::class)
           ->add('surname', TextType::class)
           ->add('subject', TextType::class)
           ->add('email', EmailType::class)
           ->add('message', TextareaType::class)
           ->add('send', SubmitType::class, array('label' => 'Envoyer'))
           ->getForm();

        $content = $this->renderView('rdnSiteBundle:Home:contact.html.twig',array('form' => $form->createView()));

        return new Response($content);
    }

    public function add_messageAction(Request $request)
    {
        $message = new Message();
        $post = $_POST['form'];
        $message->setName($post['name']);
        $message->setSurname($post['surname']);
        $message->setSubject($post['subject']);
        $message->setEmail($post['email']);
        $message->setMessage($post['message']);

        // On récupère l'EntityManager
         $em = $this->getDoctrine()->getManager();

         // Étape 1 : On « persiste » l'entité
         $em->persist($message);

         // Étape 2 : On « flush » tout ce qui a été persisté avant
         $em->flush();

         $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

         // Puis on redirige vers la page de visualisation de cettte annonce
         return $this->redirectToRoute('accueil');

    }

    public function loginAction()
    {
        $content = $this->renderView('rdnSiteBundle:Home:login.html.twig',array('nom' => 'oui'));

        return new Response($content);
    }
}
