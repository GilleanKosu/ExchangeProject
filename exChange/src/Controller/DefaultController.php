<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/successLogin", name="successLogin")
     */
    public function successLogin()
    {
        return $this->render('user.html.twig');
    }
    /**
     * @Route("/successLogin/misDatosPersonales", name="misDatosPersonales")
     */
    public function misDatosPersonales()
    {
        return $this->render('datosPersonales.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function userLogOut (Request $request): Response {//La Ruta para el deslogueo no se decide aqui, sera en el routes.yaml o security
    	return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/successLogin/actualizarDatosPersonales", name="actualizarDatosPersonales")
     */
    public function actualizarDatosPersonales(){
        
        return $this->render('datosPersonales.html.twig');
    }

    /**
     * @Route("/confirmedAttendees", name="confirmedAttendees")
     */
    public function confirmedAttendees (Request $request): Response
    {
    	$repository = $this -> getDoctrine() -> getRepository(Participants::class);
    	$participants = $repository -> findAll();

    	if (isset($_POST['candidato'])) {

    		foreach ($_POST['candidato'] as $key) {

    			$participant = $repository -> findOneByNif($key);

                if ($participant->getAttended()) {
                    $participant -> setAttended (0);
                } else {
                    $participant -> setAttended (1);
                }

    			$entityManager = $this->getDoctrine()->getManager();

    			$entityManager->merge($participant);

    			$entityManager->flush();

	
    		}
    	}

    	return $this->render('administrator.html.twig', [
            'listOfParticipants' => $participants
        ]);

    }

}
