<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Ciudad;
use App\Entity\Categoria;
use App\Entity\Servicio;
use App\Entity\Contacto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Security;
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(){

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository ->findAll();

        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudades = $repository2 ->findAll();

        $repository3 = $this -> getDoctrine() -> getRepository(Servicio::class);
        $ofertas_recientes = $repository3 ->findServicesAndOrderById();
        $mejor_valoradas = $repository3 ->findServicesAndOrderByValoracion();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'categorias' => $categorias,
            'ciudades' => $ciudades,
            'ofertas_recientes' => $ofertas_recientes,
            'mejor_valoradas' => $mejor_valoradas,
            'user' => $user
        ]);
    }
    /**
     * @Route("/successLogin", name="successLogin")
     */
    public function successLogin(){

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository ->findAll();
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudades = $repository2 ->findAll();

        return $this->render('user.html.twig', [
            'categorias' => $categorias, 
            'user' => $user,
            'ciudades' => $ciudades
        ]);
    }
    /**
     * @Route("/successLogin/misDatosPersonales", name="misDatosPersonales")
     */
    public function misDatosPersonales(){

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudades = $repository2 ->findAll();
        $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository ->findAll();
        
        return $this->render('datosPersonales.html.twig', [
            'ciudades' => $ciudades, 
            'user' => $user,
            'categorias' => $categorias
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

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        $repository = $this -> getDoctrine() -> getRepository(User::class);
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $repository3 = $this -> getDoctrine() -> getRepository(Categoria::class);

        $cosa = $_POST['username'];
        $usuario = $repository -> findOneByEmail($cosa);
        $ciudades = $repository2 ->findAll();
        $categorias = $repository3 ->findAll();

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
            'ciudades' => $ciudades,
            'user' => $user,
            'categorias' => $categorias
        ]);
    }
    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto() {

        if (isset($_POST['contact-submit'])) {

            $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
            $categorias = $repository ->findAll();
            $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
            $ciudades = $repository2 ->findAll();

            $token = $this->get('security.token_storage')->getToken();
            $user = $token->getUser();

            $nuevo_contacto = new Contacto();
            $nuevo_contacto->setNombre($_POST['name']);
            $nuevo_contacto->setEmail($_POST['email']);
            $nuevo_contacto->setInformacion($_POST['contact-info']);
            
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($nuevo_contacto);
            $entityManager->flush();

            return $this->render('contacto.html.twig', [
                'user' => $user,
                'categorias' => $categorias,
                'ciudades' => $ciudades
            ]);

        } else {

            $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
            $categorias = $repository ->findAll();
            $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
            $ciudades = $repository2 ->findAll();

            $token = $this->get('security.token_storage')->getToken();
            $user = $token->getUser();

            return $this->render('contacto.html.twig', [
                'user' => $user,
                'categorias' => $categorias,
                'ciudades' => $ciudades
            ]);

        }

        
        
    }
    /**
     * @Route("/enviaroferta", name="ofertas")
     */
    public function ofertas() {

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        $repository2 = $this -> getDoctrine() -> getRepository(Categoria::class);

        $repository3 = $this -> getDoctrine() -> getRepository(User::class);

        $repository4 = $this -> getDoctrine() -> getRepository(Servicio::class);

        $ciudades = $repository2 ->findAll();

        $usuario = $repository3 ->findOneByEmail($user->getEmail());

        $categoria = $repository2 -> findOneByName($_POST['servicio']);

        $crearOferta = new Servicio ();

        $crearOferta->setDuracionServicio($_POST['duracionservicio']);
        $crearOferta->setDescripcionServicio($_POST['descripcion']);
        $crearOferta->setIdCategoria($categoria);
        $crearOferta->setHorasDia($_POST['duracionservicio']);
        $crearOferta->setDate(date("Ymd"));

        $entityManager = $this->getDoctrine()->getManager();

        //Buscamos la ciudad del usuarioy añadimos ese servicio(el metodo coge solo la id de la ciudad y la mete en las tablas correspondientes)
        $user->getCiudad()->addServicio($crearOferta);
        
        $user->addServicio($crearOferta);

        $entityManager->merge($user);
        $entityManager->flush();

        return $this->render('correcto.html.twig');
        
    }

    /**
     * @Route("/buscarservicios", name="buscarservicios")
     */
    public function buscarservicios() {
        
        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        //Repositorios y metodos de las cosas con las que necesitamos trabajar o pasar a la vista
        $repository = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudad = $repository -> findOneByName($_POST['ciudades']);

        $repository2 = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository2 ->findAll();

        $ciudades = $repository ->findAll();
        
        //Obtenemos todos los servicios de esa ciudad
        $serviciosPorCiudad = $ciudad -> getServicios();

        //Recorremos esos servicios y buscamos cual coincide con la categoria escogida
        foreach ($serviciosPorCiudad as $key => $value) {

            //Guardamos esos servicios para luego pasarlos por parametro
            if ( ($value->getIdCategoria()) == ($_POST['categorias'])) {
                $listaServicios[] = $serviciosPorCiudad[$key];
            }
        }

        //Si ha encontrado los servicios que se correspondan los pasará a la vista
        if(isset($listaServicios)) {

            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
                'categorias' => $categorias,
                'ciudades' => $ciudades,
                'serviciosPorCiudad' => $listaServicios,
                'user' => $user
            ]);
            
        } else { //Si no los ha encontrado generará una variable de error que se mostrará en la vista

            $error = "No se ha encontrado ningun servicio para esa ciudad";
            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
                'categorias' => $categorias,
                'ciudades' => $ciudades,
                'errorServicio' => $error,
                'user' => $user
            ]);

        }

    }

    /**
     * @Route("/legal", name="avisoLegal")
     */
    public function avisoLegal() {

        $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository ->findAll();
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudades = $repository2 ->findAll();

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();

        return $this->render('legal.html.twig', [
            'user' => $user,
            'categorias' => $categorias,
            'ciudades' => $ciudades
        ]);
        
    }
    /**
     * @Route("/search", name="busqueda")
     */
    public function busqueda() {

        $repository = $this -> getDoctrine() -> getRepository(Categoria::class);
        $categorias = $repository ->findAll();
        $repository2 = $this -> getDoctrine() -> getRepository(Ciudad::class);
        $ciudades = $repository2 ->findAll();

        $token = $this->get('security.token_storage')->getToken();
        $user = $token->getUser();
        return $this->render('search.html.twig', [
            'user' => $user,
            'categorias' => $categorias,
            'ciudades' => $ciudades
        ]);
        
    }

    // /**
    //  * @Route("/msg_cont", name="mensaje_Contacto")
    //  */
    // public function mensajeContacto() {

    //     // $token = $this->get('security.token_storage')->getToken();
    //     // $user = $token->getUser();

    //     $token = $this->get('security.token_storage')->getToken();
    //     $user = $token->getUser();
    //     return $this->render('search.html.twig', [
    //         'user' => $user,
    //         'categorias' => $categorias,
    //         'ciudades' => $ciudades
    //     ]);
        
    // }



}
