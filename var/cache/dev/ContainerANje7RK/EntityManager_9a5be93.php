<?php

namespace ContainerANje7RK;
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'persistence'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'Persistence'.\DIRECTORY_SEPARATOR.'ObjectManager.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolderf6e05 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializere8595 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesc2c42 = [
        
    ];

    public function getConnection()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getConnection', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getMetadataFactory', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getExpressionBuilder', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'beginTransaction', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->beginTransaction();
    }

    public function getCache()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getCache', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getCache();
    }

    public function transactional($func)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'transactional', array('func' => $func), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'wrapInTransaction', array('func' => $func), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'commit', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->commit();
    }

    public function rollback()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'rollback', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getClassMetadata', array('className' => $className), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'createQuery', array('dql' => $dql), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'createNamedQuery', array('name' => $name), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'createQueryBuilder', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'flush', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'clear', array('entityName' => $entityName), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->clear($entityName);
    }

    public function close()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'close', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->close();
    }

    public function persist($entity)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'persist', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'remove', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'refresh', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'detach', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'merge', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getRepository', array('entityName' => $entityName), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'contains', array('entity' => $entity), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getEventManager', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getConfiguration', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'isOpen', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getUnitOfWork', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getProxyFactory', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'initializeObject', array('obj' => $obj), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'getFilters', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'isFiltersStateClean', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'hasFilters', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return $this->valueHolderf6e05->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializere8595 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderf6e05) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderf6e05 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderf6e05->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, '__get', ['name' => $name], $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        if (isset(self::$publicPropertiesc2c42[$name])) {
            return $this->valueHolderf6e05->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf6e05;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderf6e05;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, '__set', array('name' => $name, 'value' => $value), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf6e05;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderf6e05;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, '__isset', array('name' => $name), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf6e05;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolderf6e05;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, '__unset', array('name' => $name), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf6e05;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolderf6e05;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, '__clone', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        $this->valueHolderf6e05 = clone $this->valueHolderf6e05;
    }

    public function __sleep()
    {
        $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, '__sleep', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;

        return array('valueHolderf6e05');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializere8595 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializere8595;
    }

    public function initializeProxy() : bool
    {
        return $this->initializere8595 && ($this->initializere8595->__invoke($valueHolderf6e05, $this, 'initializeProxy', array(), $this->initializere8595) || 1) && $this->valueHolderf6e05 = $valueHolderf6e05;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderf6e05;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderf6e05;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
