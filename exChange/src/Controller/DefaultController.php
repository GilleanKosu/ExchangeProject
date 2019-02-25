<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Ciudad;
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
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudades = $repository2 ->findAll();
        return $this->render('datosPersonales.html.twig', [
            'ciudades' => $ciudades
        ]);
        
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

        // var_dump($_POST);
        $repository = $this -> getDoctrine() -> getRepository(User::class);
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);

        $cosa = $_POST['username'];
        $usuario = $repository -> findOneByEmail($cosa);
        $ciudades = $repository2 ->findAll();
        $ciudadSeleccionada = $repository2 ->findOneByName($_POST['ciudad']);

        $usuario->setNombreUsuario($_POST['nombreUsuario']);
        $usuario->setPassword($_POST['password']);
        $usuario->setCiudad($ciudadSeleccionada);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($usuario);
        $entityManager->flush();
        
        return $this->render('datosPersonales.html.twig', [
            'ciudades' => $ciudades
        ]);
    }


}
