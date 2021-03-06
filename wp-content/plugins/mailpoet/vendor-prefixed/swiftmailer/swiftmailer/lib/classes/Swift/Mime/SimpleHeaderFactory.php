<?php
namespace MailPoetVendor;
if (!defined('ABSPATH')) exit;
use MailPoetVendor\Egulias\EmailValidator\EmailValidator;
class Swift_Mime_SimpleHeaderFactory implements Swift_Mime_CharsetObserver
{
 private $encoder;
 private $paramEncoder;
 private $emailValidator;
 private $charset;
 private $addressEncoder;
 public function __construct(Swift_Mime_HeaderEncoder $encoder, Swift_Encoder $paramEncoder, EmailValidator $emailValidator, $charset = null, Swift_AddressEncoder $addressEncoder = null)
 {
 $this->encoder = $encoder;
 $this->paramEncoder = $paramEncoder;
 $this->emailValidator = $emailValidator;
 $this->charset = $charset;
 $this->addressEncoder = $addressEncoder ?? new Swift_AddressEncoder_IdnAddressEncoder();
 }
 public function createMailboxHeader($name, $addresses = null)
 {
 $header = new Swift_Mime_Headers_MailboxHeader($name, $this->encoder, $this->emailValidator, $this->addressEncoder);
 if (isset($addresses)) {
 $header->setFieldBodyModel($addresses);
 }
 $this->setHeaderCharset($header);
 return $header;
 }
 public function createDateHeader($name, \DateTimeInterface $dateTime = null)
 {
 $header = new Swift_Mime_Headers_DateHeader($name);
 if (isset($dateTime)) {
 $header->setFieldBodyModel($dateTime);
 }
 $this->setHeaderCharset($header);
 return $header;
 }
 public function createTextHeader($name, $value = null)
 {
 $header = new Swift_Mime_Headers_UnstructuredHeader($name, $this->encoder);
 if (isset($value)) {
 $header->setFieldBodyModel($value);
 }
 $this->setHeaderCharset($header);
 return $header;
 }
 public function createParameterizedHeader($name, $value = null, $params = [])
 {
 $header = new Swift_Mime_Headers_ParameterizedHeader($name, $this->encoder, 'content-disposition' == \strtolower($name ?? '') ? $this->paramEncoder : null);
 if (isset($value)) {
 $header->setFieldBodyModel($value);
 }
 foreach ($params as $k => $v) {
 $header->setParameter($k, $v);
 }
 $this->setHeaderCharset($header);
 return $header;
 }
 public function createIdHeader($name, $ids = null)
 {
 $header = new Swift_Mime_Headers_IdentificationHeader($name, $this->emailValidator);
 if (isset($ids)) {
 $header->setFieldBodyModel($ids);
 }
 $this->setHeaderCharset($header);
 return $header;
 }
 public function createPathHeader($name, $path = null)
 {
 $header = new Swift_Mime_Headers_PathHeader($name, $this->emailValidator);
 if (isset($path)) {
 $header->setFieldBodyModel($path);
 }
 $this->setHeaderCharset($header);
 return $header;
 }
 public function charsetChanged($charset)
 {
 $this->charset = $charset;
 $this->encoder->charsetChanged($charset);
 $this->paramEncoder->charsetChanged($charset);
 }
 public function __clone()
 {
 $this->encoder = clone $this->encoder;
 $this->paramEncoder = clone $this->paramEncoder;
 $this->addressEncoder = clone $this->addressEncoder;
 }
 private function setHeaderCharset(Swift_Mime_Header $header)
 {
 if (isset($this->charset)) {
 $header->setCharset($this->charset);
 }
 }
}
