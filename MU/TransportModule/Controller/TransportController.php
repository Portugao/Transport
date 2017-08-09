<?php
/**
 * Transport.
 *
 * @copyright Michael Ueberschaer (MU)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Michael Ueberschaer <info@homepages-mit-zikula.de>.
 * @link https://homepages-mit-zikula.de
 * @link http://zikula.org
 * @version Generated by ModuleStudio (https://modulestudio.de).
 */

namespace MU\TransportModule\Controller;

use MU\TransportModule\Controller\Base\AbstractTransportController;

use RuntimeException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Zikula\ThemeModule\Engine\Annotation\Theme;

/**
 * Transport controller implementation class.
 *
 * @Route("/transport")
 */

/**
 * Table controller class providing navigation and interaction functionality.
 */
class TransportController extends AbstractTransportController
{
	/**
	 * This method takes care of the application configuration.
	 *
	 * @Route("/select2databases",
	 *        methods = {"GET", "POST"}
	 * )
	 * @Theme("admin")
	 *
	 * @param Request $request Current request instance
	 *
	 * @return Response Output
	 *
	 * @throws AccessDeniedException Thrown if the user doesn't have required permissions
	 */
	public function select2DatabasesAction(Request $request)
	{
		return parent::selectAction($request);
	}
	
	/**
	 * This method takes care of the application configuration.
	 *
	 * @Route("/select2tables",
	 *        methods = {"GET", "POST"}
	 * )
	 * @Theme("admin")
	 *
	 * @param Request $request Current request instance
	 *
	 * @return Response Output
	 *
	 * @throws AccessDeniedException Thrown if the user doesn't have required permissions
	 */
	public function select2TablesAction(Request $request)
	{
		return parent::select2Action($request);
	}
	
	/**
	 * This method takes care of the application configuration.
	 *
	 * @Route("/handlefields",
	 *        methods = {"GET", "POST"}
	 * )
	 * @Theme("admin")
	 *
	 * @param Request $request Current request instance
	 *
	 * @return Response Output
	 *
	 * @throws AccessDeniedException Thrown if the user doesn't have required permissions
	 */
	public function handleFieldsAction(Request $request)
	{
		return parent::select3Action($request);
	}

    // feel free to add your own controller methods here
}
