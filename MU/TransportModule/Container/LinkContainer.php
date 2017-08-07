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

namespace MU\TransportModule\Container;

use MU\TransportModule\Container\Base\AbstractLinkContainer;

use Zikula\Core\LinkContainer\LinkContainerInterface;

/**
 * This is the link container service implementation class.
 */
class LinkContainer extends AbstractLinkContainer
{
	/**
	 * Returns available header links.
	 *
	 * @param string $type The type to collect links for
	 *
	 * @return array Array of header links
	 */
	public function getLinks($type = LinkContainerInterface::TYPE_ADMIN)
	{
        $links = parent::getLinks($type = LinkContainerInterface::TYPE_ADMIN);
        
        $contextArgs = ['api' => 'linkContainer', 'action' => 'getLinks'];
        $allowedObjectTypes = $this->controllerHelper->getObjectTypes('api', $contextArgs);

        $permLevel = LinkContainerInterface::TYPE_ADMIN == $type ? ACCESS_ADMIN : ACCESS_READ;
        $routeArea = LinkContainerInterface::TYPE_ADMIN == $type ? 'admin' : '';
        
        if ($routeArea == 'admin' && $this->permissionApi->hasPermission($this->getBundleName() . '::', '::', ACCESS_ADMIN)) {
        	$links[] = [
        			'url' => $this->router->generate('mutransportmodule_transport_select2databases'),
        			'text' => $this->__('Database select', 'mutransportmodule'),
        			'title' => $this->__('Select 2 databases for transport of datas', 'mutransportmodule'),
        			'icon' => 'wrench'
        	];
        }
        
        return $links;
	}
}
