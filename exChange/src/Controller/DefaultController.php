<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Ciudad;
use App\Entity\Categoria;
use App\Entity\Servicio;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
        $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository ->findAll();
        return $this->render('user.html.twig', [
            'categorias' => $categorias
        ]);
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
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto() {

        return $this->render('contacto.html.twig');
        
    }
    /**
     * @Route("/enviaroferta", name="ofertas")
     */
    public function ofertas() {
        
        // $repository = $this -> getDoctrine() -> getRepository(User::class);
        // $usuario = $repository -> findOneByEmail($_POST['username']);
        $repository2 = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categoria = $repository2 -> findOneByName($_POST['servicio']);

        $crearOferta = new Servicio ();

        $crearOferta->setDuracionServicio($_POST['duracionservicio']);
        $crearOferta->setDescripcionServicio($_POST['descripcion']);
        $crearOferta->setIdCategoria($categoria);
        $crearOferta->setHorasDia($_POST['duracionservicio']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($crearOferta);
        $entityManager->flush();

        return $this->redirectToRoute('successLogin');
        
    }


}
