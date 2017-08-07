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

namespace MU\TransportModule\Helper\Base;

use Zikula\Common\Translator\TranslatorInterface;
use MU\TransportModule\Entity\TableEntity;
use MU\TransportModule\Entity\DatabaseEntity;
use MU\TransportModule\Entity\FieldEntity;
use MU\TransportModule\Helper\ListEntriesHelper;

/**
 * Entity display helper base class.
 */
abstract class AbstractEntityDisplayHelper
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var ListEntriesHelper Helper service for managing list entries
     */
    protected $listEntriesHelper;

    /**
     * EntityDisplayHelper constructor.
     *
     * @param TranslatorInterface $translator        Translator service instance
     * @param ListEntriesHelper   $listEntriesHelper Helper service for managing list entries
     */
    public function __construct(
        TranslatorInterface $translator,
        ListEntriesHelper $listEntriesHelper
    ) {
        $this->translator = $translator;
        $this->listEntriesHelper = $listEntriesHelper;
    }

    /**
     * Returns the formatted title for a given entity.
     *
     * @param object $entity The given entity instance
     *
     * @return string The formatted title
     */
    public function getFormattedTitle($entity)
    {
        if ($entity instanceof TableEntity) {
            return $this->formatTable($entity);
        }
        if ($entity instanceof DatabaseEntity) {
            return $this->formatDatabase($entity);
        }
        if ($entity instanceof FieldEntity) {
            return $this->formatField($entity);
        }
    
        return '';
    }
    
    /**
     * Returns the formatted title for a given entity.
     *
     * @param TableEntity $entity The given entity instance
     *
     * @return string The formatted title
     */
    protected function formatTable(TableEntity $entity)
    {
        return $this->translator->__f('%name%', [
            '%name%' => $entity->getName()
        ]);
    }
    
    /**
     * Returns the formatted title for a given entity.
     *
     * @param DatabaseEntity $entity The given entity instance
     *
     * @return string The formatted title
     */
    protected function formatDatabase(DatabaseEntity $entity)
    {
        return $this->translator->__f('%name%', [
            '%name%' => $entity->getName()
        ]);
    }
    
    /**
     * Returns the formatted title for a given entity.
     *
     * @param FieldEntity $entity The given entity instance
     *
     * @return string The formatted title
     */
    protected function formatField(FieldEntity $entity)
    {
        return $this->translator->__f('%fieldName%', [
            '%fieldName%' => $entity->getFieldName()
        ]);
    }
    
    /**
     * Returns name of the field used as title / name for entities of this repository.
     *
     * @param string $objectType Name of treated entity type
     *
     * @return string Name of field to be used as title
     */
    public function getTitleFieldName($objectType)
    {
        if ($objectType == 'table') {
            return 'name';
        }
        if ($objectType == 'database') {
            return 'name';
        }
        if ($objectType == 'field') {
            return 'fieldName';
        }
    
        return '';
    }
    
    /**
     * Returns name of the field used for describing entities of this repository.
     *
     * @param string $objectType Name of treated entity type
     *
     * @return string Name of field to be used as description
     */
    public function getDescriptionFieldName($objectType)
    {
        if ($objectType == 'table') {
            return 'description';
        }
        if ($objectType == 'database') {
            return 'dbName';
        }
        if ($objectType == 'field') {
            return 'fieldKey';
        }
    
        return '';
    }
    
    /**
     * Returns name of the date(time) field to be used for representing the start
     * of this object. Used for providing meta data to the tag module.
     *
     * @param string $objectType Name of treated entity type
     *
     * @return string Name of field to be used as date
     */
    public function getStartDateFieldName($objectType)
    {
        if ($objectType == 'table') {
            return 'createdDate';
        }
        if ($objectType == 'database') {
            return 'createdDate';
        }
        if ($objectType == 'field') {
            return 'createdDate';
        }
    
        return '';
    }
}
