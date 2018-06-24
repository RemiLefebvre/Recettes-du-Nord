<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace rdn\SiteBundle\Controller;

use rdn\SiteBundle\Entity\Home;
use rdn\SiteBundle\Entity\Message;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// POST GET
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

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

    public function rechercheAction(Request $request)
    {

      $post = $request->request->get('name');

      // On récupère le repository
        $em = $this->getDoctrine()
          ->getManager()
          ->getRepository('rdnSiteBundle:Home');

        $recettes = $em->createQueryBuilder('o')
         ->where('o.name LIKE :name')
         ->setParameter('name', '%'.$post.'%')
         ->getQuery()
         ->getResult();

         if ($recettes == NULL) {
           $message_title = "Aucune recettes trouvées";
           $message = "Ardis le me le une tchotte fois! ".$post ." ?";
           $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));
         }
         else {
           $content = $this->renderView('rdnSiteBundle:Home:recettes.html.twig',array('recettes' => $recettes));
         }

        return new Response($content);
    }


    public function recetteAction($id)
    {
      // On récupère le repository
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('rdnSiteBundle:Home');

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
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }


        $message = new Message();
        $post = $_POST['form'];
        $message->setIp($ip);
        $message->setName($post['name']);
        $message->setSurname($post['surname']);
        $message->setSubject($post['subject']);
        $message->setEmail($post['email']);
        $message->setMessage($post['message']);


        // VERIF IF LAST IP
        $repository = $this->getDoctrine()
          ->getManager()
          ->getRepository('rdnSiteBundle:Message');

        $query = $repository->createQueryBuilder('message')
        ->select('message.ip')
        ->orderBy('message.id', 'DESC')
        ->getQuery();

        $last_ip_message = $query->setMaxResults(1)->getOneOrNullResult();
        if ($last_ip_message['ip'] == $ip) {
          $message_title = "Oh! Vous avez déja envoyé un message il y a peu";
          $message = "Réessayez un peu plus tard";
          $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));
          return new Response($content);
        }

       // On récupère l'EntityManager
       $em = $this->getDoctrine()->getManager();

       // Étape 1 : On « persiste » l'entité
       $em->persist($message);

       // Étape 2 : On « flush » tout ce qui a été persisté avant
       $em->flush();

       // Puis on redirige vers la page de visualisation de cettte annonce
       $message_title = "Message bien envoyé !";
       $message = "I’a bin fait sin burre ";
       $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));

       return new Response($content);
    }

    public function create_accountAction()
    {
      if (!isset($_POST['name']) OR !isset($_POST['email']) OR !isset($_POST['mdp']) OR !isset($_POST['mdpConf']) ) {
        $message_title = "Tout les champs non pas étaient remplis!";
        $message = "Arvette bin s'que teu note !";
        $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));
        return new Response($content);
      }
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $mdp = htmlspecialchars($_POST['mdp']);
      $mdpConf = htmlspecialchars($_POST['mdpConf']);

      // $user = new User();
      $userManager = $this->get('fos_user.user_manager');

      $email_exist = $userManager->findUserByEmail($email);
       if($email_exist){
         $message_title = "Cette adresse email existe déja.";
         $message = "L'adresse email {$email} est déja utilisée";
         $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));
         return new Response($content);
       }

       if ($mdp != $mdpConf) {
         $message_title = "Les mots de passe ne sont pas identiques";
         $message = "Arvette bin s'que teu note !";
         $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));
         return new Response($content);
       }

      $user = $userManager->createUser();
      $user->setUsernameCanonical($name);
      $user->setUsername($name);
      $user->setEmail($email);
      $user->setEmailCanonical($email);
      $user->setEnabled(1);
      $user->setPlainPassword($mdp);

      $userManager->updateUser($user);

      $message_title = "Bonjour {$name}, votre compte est près !";
      $message = "Pour vous connecter, utilisez votre nom de compte (votre email) : {$email}";
      $content = $this->renderView('rdnSiteBundle:Home:message.html.twig',array('message_title' => $message_title , 'message' => $message));
      return new Response($content);
    }
}
