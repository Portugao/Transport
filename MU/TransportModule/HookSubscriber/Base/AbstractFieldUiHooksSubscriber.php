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

namespace MU\TransportModule\HookSubscriber\Base;

use Zikula\Bundle\HookBundle\Category\UiHooksCategory;
use Zikula\Bundle\HookBundle\HookSubscriberInterface;
use Zikula\Common\Translator\TranslatorInterface;

/**
 * Base class for ui hooks subscriber.
 */
abstract class AbstractFieldUiHooksSubscriber implements HookSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * FieldUiHooksSubscriber constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     */
    public function getOwner()
    {
        return 'MUTransportModule';
    }
    
    /**
     * @inheritDoc
     */
    public function getCategory()
    {
        return UiHooksCategory::NAME;
    }
    
    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->translator->__('Field ui hooks subscriber');
    }

    /**
     * @inheritDoc
     */
    public function getEvents()
    {
        return [
            // Display hook for view/display templates.
            UiHooksCategory::TYPE_DISPLAY_VIEW => 'mutransportmodule.ui_hooks.fields.display_view',
            // Validate input from an item to be edited.
            UiHooksCategory::TYPE_VALIDATE_EDIT => 'mutransportmodule.ui_hooks.fields.validate_edit',
            // Perform the final update actions for an edited item.
            UiHooksCategory::TYPE_PROCESS_EDIT => 'mutransportmodule.ui_hooks.fields.process_edit',
            // Display hook for delete forms.
            UiHooksCategory::TYPE_FORM_DELETE => 'mutransportmodule.ui_hooks.fields.form_delete',
            // Validate input from an item to be deleted.
            UiHooksCategory::TYPE_VALIDATE_DELETE => 'mutransportmodule.ui_hooks.fields.validate_delete',
            // Perform the final delete actions for a deleted item.
            UiHooksCategory::TYPE_PROCESS_DELETE => 'mutransportmodule.ui_hooks.fields.process_delete'
        ];
    }
}
