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
    public function index(){
        
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * @Route("/successLogin", name="successLogin")
     */
    public function successLogin()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('user.html.twig');
    }
    /**
     * @Route("/successLogin/misDatosPersonales", name="misDatosPersonales")
     */
    public function misDatosPersonales()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
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

        $repository = $this -> getDoctrine() -> getRepository(User::class);
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);

        $cosa = $_POST['username'];
        $usuario = $repository -> findOneByEmail($cosa);
        $ciudades = $repository2 ->findAll();
        $ciudadSeleccionada = $repository2 ->findOneByName($_POST['ciudad']);

        $usuario->setNombreUsuario($_POST['nombreUsuario']);
        $usuario->setPassword(password_hash($_POST['password'], PASSWORD_ARGON2I));
        $usuario->setCiudad($ciudadSeleccionada);

        if(isset($_FILES['imagenes'])) {

            move_uploaded_file($_FILES['imagenes']['tmp_name'], '../assets/images/'.$_FILES['imagenes']['name']);
            $usuario->setImagenUsuario($_FILES['imagenes']['name']);

         }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->merge($usuario);
        $entityManager->flush();
        
        return $this->render('datosPersonales.html.twig', [
            'ciudades' => $ciudades
        ]);
    }


}
