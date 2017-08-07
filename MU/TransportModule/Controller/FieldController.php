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

use MU\TransportModule\Controller\Base\AbstractFieldController;

use RuntimeException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Zikula\ThemeModule\Engine\Annotation\Theme;
use MU\TransportModule\Entity\FieldEntity;
use PDO;

/**
 * Field controller class providing navigation and interaction functionality.
 */
class FieldController extends AbstractFieldController
{
    /**
     * @inheritDoc
     *
     * @Route("/admin/fields/view/{sort}/{sortdir}/{pos}/{num}.{_format}",
     *        requirements = {"sortdir" = "asc|desc|ASC|DESC", "pos" = "\d+", "num" = "\d+", "_format" = "html"},
     *        defaults = {"sort" = "", "sortdir" = "asc", "pos" = 1, "num" = 10, "_format" = "html"},
     *        methods = {"GET"}
     * )
     * @Theme("admin")
     *
     * @param Request $request Current request instance
     * @param string $sort         Sorting field
     * @param string $sortdir      Sorting direction
     * @param int    $pos          Current pager position
     * @param int    $num          Amount of entries to display
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function adminViewAction(Request $request, $sort, $sortdir, $pos, $num)
    {
        return parent::adminViewAction($request, $sort, $sortdir, $pos, $num);
    }
    
    /**
     * @inheritDoc
     *
     * @Route("/fields/view/{sort}/{sortdir}/{pos}/{num}.{_format}",
     *        requirements = {"sortdir" = "asc|desc|ASC|DESC", "pos" = "\d+", "num" = "\d+", "_format" = "html"},
     *        defaults = {"sort" = "", "sortdir" = "asc", "pos" = 1, "num" = 10, "_format" = "html"},
     *        methods = {"GET"}
     * )
     *
     * @param Request $request Current request instance
     * @param string $sort         Sorting field
     * @param string $sortdir      Sorting direction
     * @param int    $pos          Current pager position
     * @param int    $num          Amount of entries to display
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function viewAction(Request $request, $sort, $sortdir, $pos, $num)
    {
        return parent::viewAction($request, $sort, $sortdir, $pos, $num);
    }
    /**
     * @inheritDoc
     *
     * @Route("/admin/field/delete/{id}.{_format}",
     *        requirements = {"id" = "\d+", "_format" = "html"},
     *        defaults = {"_format" = "html"},
     *        methods = {"GET", "POST"}
     * )
     * @Theme("admin")
     *
     * @param Request $request Current request instance
     * @param FieldEntity $field Treated field instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     * @throws NotFoundHttpException Thrown by param converter if field to be deleted isn't found
     * @throws RuntimeException      Thrown if another critical error occurs (e.g. workflow actions not available)
     */
    public function adminDeleteAction(Request $request, FieldEntity $field)
    {
        return parent::adminDeleteAction($request, $field);
    }
    
    /**
     * @inheritDoc
     *
     * @Route("/field/delete/{id}.{_format}",
     *        requirements = {"id" = "\d+", "_format" = "html"},
     *        defaults = {"_format" = "html"},
     *        methods = {"GET", "POST"}
     * )
     *
     * @param Request $request Current request instance
     * @param FieldEntity $field Treated field instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     * @throws NotFoundHttpException Thrown by param converter if field to be deleted isn't found
     * @throws RuntimeException      Thrown if another critical error occurs (e.g. workflow actions not available)
     */
    public function deleteAction(Request $request, FieldEntity $field)
    {
        return parent::deleteAction($request, $field);
    }
    /**
     * @inheritDoc
     *
     * @Route("/admin/fields/getFields",
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
    public function adminGetFieldsAction(Request $request)
    {
        return parent::adminGetFieldsAction($request);
    }
    
    /**
     * @inheritDoc
     *
     * @Route("/fields/getFields",
     *        methods = {"GET", "POST"}
     * )
     *
     * @param Request $request Current request instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function getFieldsAction(Request $request)
    {
        return parent::getFieldsAction($request);
    }
    
    /**
     * This method includes the common implementation code for adminGetFields() and getFields().
     */
    protected function getFieldsInternal(Request $request, $isAdmin = false)
    {
    	// parameter specifying which type of objects we are treating
    	$objectType = 'field';
    	$permLevel = $isAdmin ? ACCESS_ADMIN : ACCESS_OVERVIEW;
    	if (!$this->hasPermission('MUTransportModule:' . ucfirst($objectType) . ':', '::', $permLevel)) {
    		throw new AccessDeniedException();
    	}
    
    	$templateParameters = [
    			'routeArea' => $isAdmin ? 'admin' : ''
    	];
    	
    	$controllerHelper = $this->get('mu_transport_module.controller_helper');
    	$modelHelper = $this->get('mu_transport_module.model_helper');
    	
    	$tableId = $controllerHelper->getParameter('table');

    	$tableRepository = $modelHelper->getRepository('table');
    	$table = $tableRepository->findOneBy(array('id' => $tableId));
    	$database = $table['database'];

    	$conn = new \PDO('mysql:dbname=' . $database['dbName'] . ';host=' . $database['host'], $database['dbUser'], $database['dbPassword']);
    	$statement = $conn->query('DESCRIBE ' . $table['name']);
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
    	 
    	$entityManager = $this->container->get('doctrine.entitymanager');
    	
    	foreach ($result as $field) {
    		$newField = new FieldEntity();
    		$newField->setFieldName($field['Field']);
    		$newField->setFieldKey($field['Key']);
    		$pos = strpos($field['Type'], '(');
    		if ($pos != false) {
                $length = strstr($field['Type'], '(');
                $length = str_replace('(', '', $length);
                $length = str_replace(')', '', $length);
                $newField->setFieldLength($length);
                $type = explode('(', $field['Type']);
                $newField->setFieldType($type[0]);
    		} else {
    			$newField->setFieldType($field['Type']);
    		}
    		$newField->setFieldDefault($field['Default']);
    		$newField->setFieldNull($field['Null']);
    		$newField->setFieldExtra($field['Extra']);
    		$newField->setTable($table);
    		$newField->setWorkflowState('approved');
    		$entityManager->flush();
    		$entityManager->persist($newField);
    		$fieldList[] = $field;
    	}
    	$templateParameters['fields'] = $fieldList;
    
    	// return template
    	return $this->render('@MUTransportModule/Field/getFields.html.twig', $templateParameters);
    }
    
    /**
     * @inheritDoc
     *
     * @Route("/admin/fields/copyValuesFromDatabaseToDatabase",
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
    public function adminCopyValuesFromDatabaseToDatabaseAction(Request $request)
    {
        return parent::adminCopyValuesFromDatabaseToDatabaseAction($request);
    }
    
    /**
     * @inheritDoc
     *
     * @Route("/fields/copyValuesFromDatabaseToDatabase",
     *        methods = {"GET", "POST"}
     * )
     *
     * @param Request $request Current request instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function copyValuesFromDatabaseToDatabaseAction(Request $request)
    {
        return parent::copyValuesFromDatabaseToDatabaseAction($request);
    }

    /**
     * Process status changes for multiple items.
     *
     * This function processes the items selected in the admin view page.
     * Multiple items may have their state changed or be deleted.
     *
     * @Route("/admin/fields/handleSelectedEntries",
     *        methods = {"POST"}
     * )
     * @Theme("admin")
     *
     * @param Request $request Current request instance
     *
     * @return RedirectResponse
     *
     * @throws RuntimeException Thrown if executing the workflow action fails
     */
    public function adminHandleSelectedEntriesAction(Request $request)
    {
        return parent::adminHandleSelectedEntriesAction($request);
    }
    
    /**
     * Process status changes for multiple items.
     *
     * This function processes the items selected in the admin view page.
     * Multiple items may have their state changed or be deleted.
     *
     * @Route("/fields/handleSelectedEntries",
     *        methods = {"POST"}
     * )
     *
     * @param Request $request Current request instance
     *
     * @return RedirectResponse
     *
     * @throws RuntimeException Thrown if executing the workflow action fails
     */
    public function handleSelectedEntriesAction(Request $request)
    {
        return parent::handleSelectedEntriesAction($request);
    }

    // feel free to add your own controller methods here
}
