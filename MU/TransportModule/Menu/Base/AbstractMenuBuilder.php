<?php
/**
 * Transport.
 *
 * @copyright Michael Ueberschaer (MU)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Michael Ueberschaer <info@homepages-mit-zikula.de>.
 * @link https://homepages-mit-zikula.de
 * @link https://ziku.la
 * @version Generated by ModuleStudio (https://modulestudio.de).
 */

namespace MU\TransportModule\Menu\Base;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\UsersModule\Constant as UsersConstant;
use MU\TransportModule\Entity\TableEntity;
use MU\TransportModule\Entity\DatabaseEntity;
use MU\TransportModule\Entity\FieldEntity;
use MU\TransportModule\TransportEvents;
use MU\TransportModule\Event\ConfigureItemActionsMenuEvent;
use MU\TransportModule\Helper\EntityDisplayHelper;
use MU\TransportModule\Helper\PermissionHelper;
use Zikula\UsersModule\Api\ApiInterface\CurrentUserApiInterface;

/**
 * Menu builder base class.
 */
class AbstractMenuBuilder
{
    use TranslatorTrait;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var PermissionHelper
     */
    protected $permissionHelper;

    /**
     * @var EntityDisplayHelper
     */
    protected $entityDisplayHelper;

    /**
     * @var CurrentUserApiInterface
     */
    protected $currentUserApi;

    /**
     * MenuBuilder constructor.
     *
     * @param TranslatorInterface      $translator          Translator service instance
     * @param FactoryInterface         $factory             Factory service instance
     * @param EventDispatcherInterface $eventDispatcher     EventDispatcher service instance
     * @param RequestStack             $requestStack        RequestStack service instance
     * @param PermissionHelper         $permissionHelper    PermissionHelper service instance
     * @param EntityDisplayHelper      $entityDisplayHelper EntityDisplayHelper service instance
     * @param CurrentUserApiInterface  $currentUserApi      CurrentUserApi service instance
     */
    public function __construct(
        TranslatorInterface $translator,
        FactoryInterface $factory,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack,
        PermissionHelper $permissionHelper,
        EntityDisplayHelper $entityDisplayHelper,
        CurrentUserApiInterface $currentUserApi)
    {
        $this->setTranslator($translator);
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
        $this->permissionHelper = $permissionHelper;
        $this->entityDisplayHelper = $entityDisplayHelper;
        $this->currentUserApi = $currentUserApi;
    }

    /**
     * Sets the translator.
     *
     * @param TranslatorInterface $translator Translator service instance
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Builds the item actions menu.
     *
     * @param array $options List of additional options
     *
     * @return ItemInterface The assembled menu
     */
    public function createItemActionsMenu(array $options = [])
    {
        $menu = $this->factory->createItem('itemActions');
        if (!isset($options['entity']) || !isset($options['area']) || !isset($options['context'])) {
            return $menu;
        }

        $entity = $options['entity'];
        $routeArea = $options['area'];
        $context = $options['context'];
        $menu->setChildrenAttribute('class', 'list-inline item-actions');

        $this->eventDispatcher->dispatch(TransportEvents::MENU_ITEMACTIONS_PRE_CONFIGURE, new ConfigureItemActionsMenuEvent($this->factory, $menu, $options));

        $currentUserId = $this->currentUserApi->isLoggedIn() ? $this->currentUserApi->get('uid') : UsersConstant::USER_ID_ANONYMOUS;
        if ($entity instanceof TableEntity) {
            $routePrefix = 'mutransportmodule_table_';
            $isOwner = $currentUserId > 0 && null !== $entity->getCreatedBy() && $currentUserId == $entity->getCreatedBy()->getUid();
        
            if ($routeArea == 'admin') {
                $title = $this->__('Preview', 'mutransportmodule');
                $previewRouteParameters = $entity->createUrlArgs();
                $previewRouteParameters['preview'] = 1;
                $menu->addChild($title, [
                    'route' => $routePrefix . 'display',
                    'routeParameters' => $previewRouteParameters
                ]);
                $menu[$title]->setLinkAttribute('target', '_blank');
                $menu[$title]->setLinkAttribute('title', $this->__('Open preview page', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-search-plus');
            }
            if ($context != 'display') {
                $title = $this->__('Details', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'display',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', str_replace('"', '', $this->entityDisplayHelper->getFormattedTitle($entity)));
                $menu[$title]->setAttribute('icon', 'fa fa-eye');
            }
            if ($this->permissionHelper->mayEdit($entity)) {
                $title = $this->__('Edit', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'edit',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Edit this table', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-pencil-square-o');
                $title = $this->__('Reuse', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'edit',
                    'routeParameters' => ['astemplate' => $entity->getKey()]
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Reuse for new table', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-files-o');
            }
            if ($this->permissionHelper->mayDelete($entity)) {
                $title = $this->__('Delete', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'delete',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Delete this table', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-trash-o');
            }
            if ($context == 'display') {
                $title = $this->__('Tables list', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'view'
                ]);
                $menu[$title]->setLinkAttribute('title', $title);
                $menu[$title]->setAttribute('icon', 'fa fa-reply');
            }
            
            // more actions for adding new related items
            
            if ($isOwner || $this->permissionHelper->hasComponentPermission('field', ACCESS_EDIT)) {
                $title = $this->__('Create fields', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => 'mutransportmodule_field_' . $routeArea . 'edit',
                    'routeParameters' => ['table' => $entity->getKey()]
                ]);
                $menu[$title]->setLinkAttribute('title', $title);
                $menu[$title]->setAttribute('icon', 'fa fa-plus');
            }
        }
        if ($entity instanceof DatabaseEntity) {
            $routePrefix = 'mutransportmodule_database_';
            $isOwner = $currentUserId > 0 && null !== $entity->getCreatedBy() && $currentUserId == $entity->getCreatedBy()->getUid();
        
            if ($routeArea == 'admin') {
                $title = $this->__('Preview', 'mutransportmodule');
                $previewRouteParameters = $entity->createUrlArgs();
                $previewRouteParameters['preview'] = 1;
                $menu->addChild($title, [
                    'route' => $routePrefix . 'display',
                    'routeParameters' => $previewRouteParameters
                ]);
                $menu[$title]->setLinkAttribute('target', '_blank');
                $menu[$title]->setLinkAttribute('title', $this->__('Open preview page', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-search-plus');
            }
            if ($context != 'display') {
                $title = $this->__('Details', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'display',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', str_replace('"', '', $this->entityDisplayHelper->getFormattedTitle($entity)));
                $menu[$title]->setAttribute('icon', 'fa fa-eye');
            }
            if ($this->permissionHelper->mayEdit($entity)) {
                $title = $this->__('Edit', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'edit',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Edit this database', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-pencil-square-o');
                $title = $this->__('Reuse', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'edit',
                    'routeParameters' => ['astemplate' => $entity->getKey()]
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Reuse for new database', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-files-o');
            }
            if ($this->permissionHelper->mayDelete($entity)) {
                $title = $this->__('Delete', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'delete',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Delete this database', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-trash-o');
            }
            if ($context == 'display') {
                $title = $this->__('Databases list', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'view'
                ]);
                $menu[$title]->setLinkAttribute('title', $title);
                $menu[$title]->setAttribute('icon', 'fa fa-reply');
            }
            
            // more actions for adding new related items
            
            if ($isOwner || $this->permissionHelper->hasComponentPermission('table', ACCESS_EDIT)) {
                $title = $this->__('Create tables', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => 'mutransportmodule_table_' . $routeArea . 'edit',
                    'routeParameters' => ['database' => $entity->getKey()]
                ]);
                $menu[$title]->setLinkAttribute('title', $title);
                $menu[$title]->setAttribute('icon', 'fa fa-plus');
            }
        }
        if ($entity instanceof FieldEntity) {
            $routePrefix = 'mutransportmodule_field_';
            $isOwner = $currentUserId > 0 && null !== $entity->getCreatedBy() && $currentUserId == $entity->getCreatedBy()->getUid();
        
            if ($this->permissionHelper->mayEdit($entity)) {
                $title = $this->__('Edit', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'edit',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Edit this field', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-pencil-square-o');
                $title = $this->__('Reuse', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'edit',
                    'routeParameters' => ['astemplate' => $entity->getKey()]
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Reuse for new field', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-files-o');
            }
            if ($this->permissionHelper->mayDelete($entity)) {
                $title = $this->__('Delete', 'mutransportmodule');
                $menu->addChild($title, [
                    'route' => $routePrefix . $routeArea . 'delete',
                    'routeParameters' => $entity->createUrlArgs()
                ]);
                $menu[$title]->setLinkAttribute('title', $this->__('Delete this field', 'mutransportmodule'));
                $menu[$title]->setAttribute('icon', 'fa fa-trash-o');
            }
        }

        $this->eventDispatcher->dispatch(TransportEvents::MENU_ITEMACTIONS_POST_CONFIGURE, new ConfigureItemActionsMenuEvent($this->factory, $menu, $options));

        return $menu;
    }
}
