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

namespace MU\TransportModule\Controller\Base;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Zikula\Core\Controller\AbstractController;
use Zikula\Core\RouteUrl;
use MU\TransportModule\Entity\TableEntity;
use MU\TransportModule\Form\Type\DatabaseselectType;
use MU\TransportModule\Form\Type\TableselectType;

/**
 * Table controller base class.
 */
abstract class AbstractTransportController extends AbstractController
{
	/**
	 * This method takes care of the application configuration.
	 *
	 * @param Request $request Current request instance
	 *
	 * @return Response Output
	 *
	 * @throws AccessDeniedException Thrown if the user doesn't have required permissions
	 */
	public function selectAction(Request $request)
	{
		if (!$this->hasPermission($this->name . '::', '::', ACCESS_ADMIN)) {
			throw new AccessDeniedException();
		}
	
		$form = $this->createForm(DatabaseselectType::class);
	
		if ($form->handleRequest($request)->isValid()) {
			if ($form->get('select')->isClicked()) {
				$formData = $form->getData();
				$this->setVars($formData);
	
				$this->addFlash('status', $this->__('Done! Module configuration updated.'));
				$userName = $this->get('zikula_users_module.current_user')->get('uname');
				$this->get('logger')->notice('{app}: User {user} updated the configuration.', ['app' => 'MUTransportModule', 'user' => $userName]);
			} elseif ($form->get('cancel')->isClicked()) {
				$this->addFlash('status', $this->__('Operation cancelled.'));
			}
	
			// redirect to config page again (to show with GET request)
			return $this->redirectToRoute('mutransportmodule_transport_select2tables', array('source' => $formData['sourceDatabase'], 'target' => $formData['targetDatabase']));
		}
	
		$templateParameters = [
				'form' => $form->createView()
		];
	
		// render the config form
		return $this->render('@MUTransportModule/Transport/select2Databases.html.twig', $templateParameters);
    }
    
    /**
     * This method takes care of the application configuration.
     *
     * @param Request $request Current request instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function select2Action(Request $request)
    {
    	if (!$this->hasPermission($this->name . '::', '::', ACCESS_ADMIN)) {
    		throw new AccessDeniedException();
    	}
    
    	$form = $this->createForm(TableselectType::class);
    
    	if ($form->handleRequest($request)->isValid()) {
    		if ($form->get('select')->isClicked()) {
    			$formData = $form->getData();
    			$this->setVars($formData);
    
    			$this->addFlash('status', $this->__('Done! Module configuration updated.'));
    			$userName = $this->get('zikula_users_module.current_user')->get('uname');
    			$this->get('logger')->notice('{app}: User {user} updated the configuration.', ['app' => 'MUTransportModule', 'user' => $userName]);
    		} elseif ($form->get('cancel')->isClicked()) {
    			$this->addFlash('status', $this->__('Operation cancelled.'));
    		}
    
    		// redirect to config page again (to show with GET request)
    		return $this->redirectToRoute('mutransportmodule_transport_select');
    	}
    
    	$templateParameters = [
    			'form' => $form->createView()
    	];
    
    	// render the config form
    	return $this->render('@MUTransportModule/Transport/select2Tables.html.twig', $templateParameters);
    }
}