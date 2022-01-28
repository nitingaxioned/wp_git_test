<?php
namespace MailPoetVendor\Doctrine\Persistence;
if (!defined('ABSPATH')) exit;
use InvalidArgumentException;
use ReflectionClass;
use function explode;
use function sprintf;
use function strpos;
abstract class AbstractManagerRegistry implements ManagerRegistry
{
 private $name;
 private $connections;
 private $managers;
 private $defaultConnection;
 private $defaultManager;
 private $proxyInterfaceName;
 public function __construct($name, array $connections, array $managers, $defaultConnection, $defaultManager, $proxyInterfaceName)
 {
 $this->name = $name;
 $this->connections = $connections;
 $this->managers = $managers;
 $this->defaultConnection = $defaultConnection;
 $this->defaultManager = $defaultManager;
 $this->proxyInterfaceName = $proxyInterfaceName;
 }
 protected abstract function getService($name);
 protected abstract function resetService($name);
 public function getName()
 {
 return $this->name;
 }
 public function getConnection($name = null)
 {
 if ($name === null) {
 $name = $this->defaultConnection;
 }
 if (!isset($this->connections[$name])) {
 throw new InvalidArgumentException(sprintf('Doctrine %s Connection named "%s" does not exist.', $this->name, $name));
 }
 return $this->getService($this->connections[$name]);
 }
 public function getConnectionNames()
 {
 return $this->connections;
 }
 public function getConnections()
 {
 $connections = [];
 foreach ($this->connections as $name => $id) {
 $connections[$name] = $this->getService($id);
 }
 return $connections;
 }
 public function getDefaultConnectionName()
 {
 return $this->defaultConnection;
 }
 public function getDefaultManagerName()
 {
 return $this->defaultManager;
 }
 public function getManager($name = null)
 {
 if ($name === null) {
 $name = $this->defaultManager;
 }
 if (!isset($this->managers[$name])) {
 throw new InvalidArgumentException(sprintf('Doctrine %s Manager named "%s" does not exist.', $this->name, $name));
 }
 return $this->getService($this->managers[$name]);
 }
 public function getManagerForClass($class)
 {
 $className = $this->getRealClassName($class);
 $proxyClass = new ReflectionClass($className);
 if ($proxyClass->implementsInterface($this->proxyInterfaceName)) {
 $parentClass = $proxyClass->getParentClass();
 if (!$parentClass) {
 return null;
 }
 $className = $parentClass->getName();
 }
 foreach ($this->managers as $id) {
 $manager = $this->getService($id);
 if (!$manager->getMetadataFactory()->isTransient($className)) {
 return $manager;
 }
 }
 return null;
 }
 public function getManagerNames()
 {
 return $this->managers;
 }
 public function getManagers()
 {
 $dms = [];
 foreach ($this->managers as $name => $id) {
 $dms[$name] = $this->getService($id);
 }
 return $dms;
 }
 public function getRepository($persistentObject, $persistentManagerName = null)
 {
 return $this->selectManager($persistentObject, $persistentManagerName)->getRepository($persistentObject);
 }
 public function resetManager($name = null)
 {
 if ($name === null) {
 $name = $this->defaultManager;
 }
 if (!isset($this->managers[$name])) {
 throw new InvalidArgumentException(sprintf('Doctrine %s Manager named "%s" does not exist.', $this->name, $name));
 }
 // force the creation of a new document manager
 // if the current one is closed
 $this->resetService($this->managers[$name]);
 return $this->getManager($name);
 }
 private function selectManager(string $persistentObjectName, ?string $persistentManagerName = null) : ObjectManager
 {
 if ($persistentManagerName !== null) {
 return $this->getManager($persistentManagerName);
 }
 return $this->getManagerForClass($persistentObjectName) ?? $this->getManager();
 }
 private function getRealClassName(string $classNameOrAlias) : string
 {
 // Check for namespace alias
 if (strpos($classNameOrAlias, ':') !== \false) {
 [$namespaceAlias, $simpleClassName] = explode(':', $classNameOrAlias, 2);
 return $this->getAliasNamespace($namespaceAlias) . '\\' . $simpleClassName;
 }
 return $classNameOrAlias;
 }
}
