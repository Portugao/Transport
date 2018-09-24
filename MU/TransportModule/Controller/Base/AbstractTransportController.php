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
use MU\TransportModule\Form\Type\FieldselectType;
use PDO;

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
	
		// render the select 2 databases form
		return $this->render('@MUTransportModule/Transport/select2Databases.html.twig', $templateParameters);
    }
    
    /**
     * This method takes care of the application configuration.
     *
     * @param Request $request Current request instance
     *
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
    
    		// redirect to handle fields page again (to show with GET request)
    		return $this->redirectToRoute('mutransportmodule_transport_handlefields', array('source' => $formData['sourceTable'], 'target' => $formData['targetTable']));
    	}
    
    	$templateParameters = [
    			'form' => $form->createView()
    	];
    
    	// render the select 2 tables form
    	return $this->render('@MUTransportModule/Transport/select2Tables.html.twig', $templateParameters);
    }
    
    /**
     * This method takes care of the copying of datas from a source table to a target table
     *
     * @param Request $request Current request instance
     *
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function select3Action(Request $request)
    {
    	if (!$this->hasPermission($this->name . '::', '::', ACCESS_ADMIN)) {
    		throw new AccessDeniedException();
    	}
    	
    	// we get factory helper
    	$entityFactory = $this->get('mu_transport_module.entity_factory');
    	// we get a table repository
    	$tableRepository = $entityFactory->getRepository('table');
    
    	$form = $this->createForm(FieldselectType::class);
    	
    	$sourceEntries = array();
    
    	if ($form->handleRequest($request)->isValid()) {
    		if ($form->get('select')->isClicked()) {
    			$formData = $form->getData();
    			// we get the source table id
    			$sourceId = $formData['source'];
    			// we get the target table id
    			$targetId = $formData['target'];
    			// we get the source table
    			$sourceTable = $tableRepository->selectById($sourceId);
    			// we get the target table
    			$targetTable = $tableRepository->selectById($targetId);
    			// we get the source database
    			$sourceDatabase = $sourceTable['database'];
    			// we get the target database
    			$targetDatabase = $targetTable['database'];
    			// we get the source entries
    			$conn = new \PDO('mysql:dbname=' . $sourceDatabase['dbName'] . ';host=' . $sourceDatabase['host'], $sourceDatabase['dbUser'], $sourceDatabase['dbPassword']);
    			$result = $conn->query('SELECT * FROM ' . $sourceTable['name']);
    			while ($row = $result->fetch()) {
    				$sourceEntries[] = $row;
    			}
    			// we get the field combination string
    			$fieldCombination = $formData['fieldCombination'];
    			$fieldCombination = explode('|',$fieldCombination);
                $countCombination = count($fieldCombination);
                $count = 0;
                // we initialize the string var
                $stringValue = '';
                // we initialize the text var
                $textValue = '';
    			// we initialise the into value
    			$intoValue = '';
    			// we initialize the value value
    			$valueValue = '';
    			// we initialize the placeholder var
    			$placeholder = '';
    			// we get the into string
    			foreach ($fieldCombination as $combination) {
    				$combinationDatas = explode(';', $combination);
    				$target = $combinationDatas[0];

    				if ($countCombination - 1 > $count) {			
    				    $intoValue .= $target . ', ' ;
    				} else {
    					$intoValue .= $target;
    				}

    				$placeholder .= '?';
    				if($countCombination - 1 > $count) {
    					$placeholder .= ',';
    				}		
    				$count++;
    			}
    			
    			$conn2 = new \PDO('mysql:dbname=' . $targetDatabase['dbName'] . ';host=' . $targetDatabase['host'], $targetDatabase['dbUser'], $targetDatabase['dbPassword']);
    			
    			
    			$countCopy = 0;
    			// foreach for copy of sourceEntries to the target table
    			foreach ($sourceEntries as $entry) { 
    			    $valueValue = array();
    			    $statement2 = $conn2->prepare("INSERT INTO " . $targetTable['name'] . " (" . $intoValue . ") VALUES ($placeholder)");
    			    $count2 = 0;
    			    // foreach for value array
    			    foreach ($fieldCombination as $combination) {
    			    	$combinationDatas = explode(';', $combination);
    			    	$sources = $combinationDatas[1];
    			    	$sources = explode(',', $sources);
    			    	$countSources = count($sources);
    			    	if (is_array($sources)) {
    			    		//$count1 = 0;
    			    		foreach ($sources as $source) {
    			    			$textValue .= $entry[$source] . ' ';   			    		
    			    		}
    			    		$valueValue[] = $textValue;
    			    		$textValue = '';
    			    	} else {
    			    		$valueValue[] = $entry["' . $source . '"];
    			    	}
    			    	$count2++;
    			    }   			    
    			       			    
    			    $copyState = $statement2->execute($valueValue);
    			    $valueValue = ''; 
    			    if ($copyState == false) {
    			    	$this->addFlash('error', $this->__('There was an error during the copying!'));
    			    } else {
    			        $countCopy++;
    			    }
    			}
                if ($countCopy > 0) {
    			$this->addFlash('status', $this->__('Done! The data have been copied from the source table to the target table.')); 
                } else {
    			$this->addFlash('error', $countCopy . ' ' . $this->__('data sets was copied'));
                }
                } elseif ($form->get('cancel')->isClicked()) {
    			$this->addFlash('status', $this->__('Operation cancelled.'));
    		}
    
    		// redirect to config page again (to show with GET request)
    		return $this->redirectToRoute('mutransportmodule_transport_handlefields', array('source' => $formData['source'], 'target' => $formData['target']));
    	}
    
    	$templateParameters = [
    			'form' => $form->createView()
    	];
    	
    	$source = $request->query->getDigits('source');
    	$target = $request->query->getDigits('target');

    	// we get the source table
    	$sourceTable = $tableRepository->selectById($source);
    	// we get the target table
    	$targetTable = $tableRepository->selectById($target);
    	// we get a field repository
    	$fieldRepository = $entityFactory->getRepository('field');
    	$where = 'tbl.table = ' . $source;
    	$sourceFields = $fieldRepository->selectWhere($where);
    	 
    	$where2 = 'tbl.table = ' . $target;
    	$targetFields = $fieldRepository->selectWhere($where2);
    	
    	$templateParameters['source'] = $sourceTable;
    	$templateParameters['target'] = $targetTable;
    	 
    	$templateParameters['sources'] = $sourceFields;
    	$templateParameters['targets'] = $targetFields;
    
    	// render the handle fields form
    	return $this->render('@MUTransportModule/Transport/handleFields.html.twig', $templateParameters);
    }
}
