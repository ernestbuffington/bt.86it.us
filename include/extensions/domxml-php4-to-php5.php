<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File extensions/domxml-php4-to-php5.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    //require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    //die ();
}

function domxml_new_doc($version) {return new php4DOMDocument('');}
function domxml_new_xmldoc($version) {return new php4DOMDocument('');}
function domxml_open_file($filename) {return new php4DOMDocument($filename);}
if (!function_exists("domxml_open_mem"))
{
    function domxml_open_mem($str)
    {
     $dom=new php4DOMDocument('');
     $dom->myDOMNode->loadXML($str);
     return $dom;
    }
}
function html_doc($html_doc,$from_file=false)
{
 $dom=new php4DOMDocument('');
 if ($from_file) $dom->myDOMNode->loadHTMLFile($html_doc);
 else $dom->myDOMNode->loadHTML($html_doc);
 return $dom;
}
function html_doc_file($filename) {return html_doc($filename,true);}
if (!function_exists("xmldoc"))
{
    function xmldoc($str) {return domxml_open_mem($str);}
}
if (!function_exists("xmldocfile"))
{
    function xmldocfile($filename) {return new php4DOMDocument($filename);}
}
if (!function_exists("xpath_eval"))
{
    function xpath_eval($xpath_context,$eval_str,$contextnode=null) {return $xpath_context->xpath_eval($eval_str,$contextnode);}
}
function xpath_new_context($dom_document) {return new php4DOMXPath($dom_document);}
function xpath_register_ns($xpath_context,$prefix,$namespaceURI) {return $xpath_context->myDOMXPath->registerNamespace($prefix,$namespaceURI);}

class php4DOMAttr extends php4DOMNode
{
 function name() {return $this->myDOMNode->name;}
 function set_value($content) {return $this->myDOMNode->value=$content;}
 function specified() {return $this->myDOMNode->specified;}
 function value() {return $this->myDOMNode->value;}
}

class php4DOMDocument extends php4DOMNode
{
 function __construct($filename='')
 {
  $this->myDOMNode=new DOMDocument();
  $this->myOwnerDocument=$this;
  if ($filename!='') $this->myDOMNode->load($filename);
 }
 function add_root($name)
 {
  if ($this->myDOMNode->hasChildNodes()) $this->myDOMNode->removeChild($this->myDOMNode->firstChild);
  return new php4DOMElement($this->myDOMNode->appendChild($this->myDOMNode->createElement($name)),$this->myOwnerDocument);
 }
 function create_attribute($name,$value)
 {
  $myAttr=$this->myDOMNode->createAttribute($name);
  $myAttr->value=$value;
  return new php4DOMAttr($myAttr,$this);
 }
 function create_cdata_section($content) {return new php4DOMNode($this->myDOMNode->createCDATASection($content),$this);}
 function create_comment($data) {return new php4DOMNode($this->myDOMNode->createComment($data),$this);}
 function create_element($name) {return new php4DOMElement($this->myDOMNode->createElement($name),$this);}
 function create_element_ns($uri,$name,$prefix=null)
 {
  if ($prefix==null) $prefix=$this->myDOMNode->lookupPrefix($uri);
  if (($prefix==null)&&($this->myDOMNode->hasChildNodes())&&(!$this->myDOMNode->firstChild->isDefaultNamespace($uri))) $prefix='a'.sprintf('%u',crc32($uri));
  return new php4DOMElement($this->myDOMNode->createElementNS($uri,$prefix==null ? $name : $prefix.':'.$name),$this);
 }
 function create_entity_reference($content) {return new php4DOMNode($this->myDOMNode->createEntityReference($content),$this);} //By Walter Ebert 2007-01-22
 function create_text_node($content) {return new php4DOMText($this->myDOMNode->createTextNode($content),$this);}
 function document_element() {return parent::_newDOMElement($this->myDOMNode->documentElement,$this);}
 function dump_file($filename,$compressionmode=false,$format=false)
 {
  $format0=$this->myDOMNode->formatOutput;
  $this->myDOMNode->formatOutput=$format;
  $res=$this->myDOMNode->save($filename);
  $this->myDOMNode->formatOutput=$format0;
  return $res;
 }
 function dump_mem($format=false,$encoding=false)
 {
  $format0=$this->myDOMNode->formatOutput;
  $this->myDOMNode->formatOutput=$format;
  $encoding0=$this->myDOMNode->encoding;
  if ($encoding) $this->myDOMNode->encoding=$encoding;
  $dump=$this->myDOMNode->saveXML();
  $this->myDOMNode->formatOutput=$format0;
  if ($encoding) $this->myDOMNode->encoding= $encoding0=='' ? 'UTF-8' : $encoding0; //UTF-8 is XML default encoding
  return $dump;
 }
 function free()
 {
  if ($this->myDOMNode->hasChildNodes()) $this->myDOMNode->removeChild($this->myDOMNode->firstChild);
  $this->myDOMNode=null;
  $this->myOwnerDocument=null;
 }
 function get_element_by_id($id) {return parent::_newDOMElement($this->myDOMNode->getElementById($id),$this);}
 function get_elements_by_tagname($name)
 {
  $myDOMNodeList=$this->myDOMNode->getElementsByTagName($name);
  $nodeSet=array();
  $i=0;
  if (isset($myDOMNodeList))
   while ($node=$myDOMNodeList->item($i++)) $nodeSet[]=new php4DOMElement($node,$this);
  return $nodeSet;
 }
 function html_dump_mem() {return $this->myDOMNode->saveHTML();}
 function root() {return parent::_newDOMElement($this->myDOMNode->documentElement,$this);}
 function xpath_new_context() {return new php4DOMXPath($this);}
}

class php4DOMElement extends php4DOMNode
{
 function add_namespace($uri,$prefix)
 {
  if ($this->myDOMNode->hasAttributeNS('http://www.w3.org/2000/xmlns/',$prefix)) return false;
  else
  {
   $this->myDOMNode->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns:'.$prefix,$uri); //By Daniel Walker 2006-09-08
   return true;
  }
 }
 function get_attribute($name) {return $this->myDOMNode->getAttribute($name);}
 function get_attribute_node($name) {return parent::_newDOMElement($this->myDOMNode->getAttributeNode($name),$this->myOwnerDocument);}
 function get_elements_by_tagname($name)
 {
  $myDOMNodeList=$this->myDOMNode->getElementsByTagName($name);
  $nodeSet=array();
  $i=0;
  if (isset($myDOMNodeList))
   while ($node=$myDOMNodeList->item($i++)) $nodeSet[]=new php4DOMElement($node,$this->myOwnerDocument);
  return $nodeSet;
 }
 function has_attribute($name) {return $this->myDOMNode->hasAttribute($name);}
 function remove_attribute($name) {return $this->myDOMNode->removeAttribute($name);}
 function set_attribute($name,$value)
 {
  //return $this->myDOMNode->setAttribute($name,$value); //Does not return a DomAttr
  $myAttr=$this->myDOMNode->ownerDocument->createAttribute($name);
  $myAttr->value=$value;
  $this->myDOMNode->setAttributeNode($myAttr);
  return new php4DOMAttr($myAttr,$this->myOwnerDocument);
 }
 function set_attribute_node($attr)
 {
  $this->myDOMNode->setAttributeNode($this->_importNode($attr));
  return $attr;
 }
 function set_name($name)
 {
  if ($this->myDOMNode->prefix=='') $newNode=$this->myDOMNode->ownerDocument->createElement($name);
  else $newNode=$this->myDOMNode->ownerDocument->createElementNS($this->myDOMNode->namespaceURI,$this->myDOMNode->prefix.':'.$name);
  $myDOMNodeList=$this->myDOMNode->attributes;
  $i=0;
  if (isset($myDOMNodeList))
   while ($node=$myDOMNodeList->item($i++))
    if ($node->namespaceURI=='') $newNode->setAttribute($node->name,$node->value);
    else $newNode->setAttributeNS($node->namespaceURI,$node->nodeName,$node->value);
  $myDOMNodeList=$this->myDOMNode->childNodes;
  if (isset($myDOMNodeList))
   while ($node=$myDOMNodeList->item(0)) $newNode->appendChild($node);
  $this->myDOMNode->parentNode->replaceChild($newNode,$this->myDOMNode);
  $this->myDOMNode=$newNode;
  return true;
 }
 function tagname() {return $this->myDOMNode->tagName;}
}

class php4DOMNode
{
 public $myDOMNode;
 public $myOwnerDocument;
 function __construct($aDomNode,$aOwnerDocument)
 {
  $this->myDOMNode=$aDomNode;
  $this->myOwnerDocument=$aOwnerDocument;
 }
 function __get($name)
 {
  switch ($name)
  {
   case 'type': return $this->myDOMNode->nodeType;
   case 'tagname': return $this->myDOMNode->tagName;
   case 'content': return $this->myDOMNode->textContent;
   case 'name': return $this->myDOMNode->name;
   case 'value': return $this->myDOMNode->value;
   default:
    $myErrors=debug_backtrace();
    trigger_error('Undefined property: '.get_class($this).'::$'.$name.' ['.$myErrors[0]['file'].':'.$myErrors[0]['line'].']',E_USER_NOTICE);
    return false;
  }
 }
 function add_child($newnode) {return append_child($newnode);}
 function add_namespace($uri,$prefix) {return false;}
 function append_child($newnode) {return self::_newDOMElement($this->myDOMNode->appendChild($this->_importNode($newnode)),$this->myOwnerDocument);}
 function append_sibling($newnode) {return self::_newDOMElement($this->myDOMNode->parentNode->appendChild($this->_importNode($newnode)),$this->myOwnerDocument);}
 function attributes()
 {
  $myDOMNodeList=$this->myDOMNode->attributes;
  $nodeSet=array();
  $i=0;
  if (isset($myDOMNodeList))
   while ($node=$myDOMNodeList->item($i++)) $nodeSet[]=new php4DOMAttr($node,$this->myOwnerDocument);
  return $nodeSet;
 }
 function child_nodes()
 {
  $myDOMNodeList=$this->myDOMNode->childNodes;
  $nodeSet=array();
  $i=0;
  if (isset($myDOMNodeList))
   while ($node=$myDOMNodeList->item($i++)) $nodeSet[]=self::_newDOMElement($node,$this->myOwnerDocument);
  return $nodeSet;
 }
 function children() {return $this->child_nodes();}
 function clone_node($deep=false) {return self::_newDOMElement($this->myDOMNode->cloneNode($deep),$this->myOwnerDocument);}
 //dump_node($node) should only be called on php4DOMDocument
 function dump_node($node=null) {return $node==null ? $this->myOwnerDocument->myDOMNode->saveXML($this->myDOMNode) : $this->myOwnerDocument->myDOMNode->saveXML($node->myDOMNode);}
 function first_child() {return self::_newDOMElement($this->myDOMNode->firstChild,$this->myOwnerDocument);}
 function get_content() {return $this->myDOMNode->textContent;}
 function has_attributes() {return $this->myDOMNode->hasAttributes();}
 function has_child_nodes() {return $this->myDOMNode->hasChildNodes();}
 function insert_before($newnode,$refnode) {return self::_newDOMElement($this->myDOMNode->insertBefore($this->_importNode($newnode),$refnode->myDOMNode),$this->myOwnerDocument);}
 function is_blank_node() {return ($this->myDOMNode->nodeType==XML_TEXT_NODE)&&preg_match('%^\s*$%',$this->myDOMNode->nodeValue);}
 function last_child() {return self::_newDOMElement($this->myDOMNode->lastChild,$this->myOwnerDocument);}
 function new_child($name,$content)
 {
  $mySubNode=$this->myDOMNode->ownerDocument->createElement($name);
  $mySubNode->appendChild($this->myDOMNode->ownerDocument->createTextNode(html_entity_decode($content,ENT_QUOTES)));
  $this->myDOMNode->appendChild($mySubNode);
  return new php4DOMElement($mySubNode,$this->myOwnerDocument);
 }
 function next_sibling() {return self::_newDOMElement($this->myDOMNode->nextSibling,$this->myOwnerDocument);}
 function node_name() {return ($this->myDOMNode->nodeType==XML_ELEMENT_NODE) ? $this->myDOMNode->localName : $this->myDOMNode->nodeName;} //Avoid namespace prefix for DOMElement
 function node_type() {return $this->myDOMNode->nodeType;}
 function node_value() {return $this->myDOMNode->nodeValue;}
 function owner_document() {return $this->myOwnerDocument;}
 function parent_node() {return self::_newDOMElement($this->myDOMNode->parentNode,$this->myOwnerDocument);}
 function prefix() {return $this->myDOMNode->prefix;}
 function previous_sibling() {return self::_newDOMElement($this->myDOMNode->previousSibling,$this->myOwnerDocument);}
 function remove_child($oldchild) {return self::_newDOMElement($this->myDOMNode->removeChild($oldchild->myDOMNode),$this->myOwnerDocument);}
 function replace_child($oldnode,$newnode) {return self::_newDOMElement($this->myDOMNode->replaceChild($oldnode->myDOMNode,$this->_importNode($newnode)),$this->myOwnerDocument);}
 function set_content($text) {return $this->myDOMNode->appendChild($this->myDOMNode->ownerDocument->createTextNode($text));}
 //function set_name($name) {return $this->myOwnerDocument->renameNode($this->myDOMNode,$this->myDOMNode->namespaceURI,$name);}
 function set_namespace($uri,$prefix=null)
 {//Contributions by Daniel Walker 2006-09-08
  $nsprefix=$this->myDOMNode->lookupPrefix($uri);
  if ($nsprefix==null)
  {
   $nsprefix= $prefix==null ? $nsprefix='a'.sprintf('%u',crc32($uri)) : $prefix;
   if ($this->myDOMNode->nodeType==XML_ATTRIBUTE_NODE)
   {
    if (($prefix!=null)&&$this->myDOMNode->ownerElement->hasAttributeNS('http://www.w3.org/2000/xmlns/',$nsprefix)&&
        ($this->myDOMNode->ownerElement->getAttributeNS('http://www.w3.org/2000/xmlns/',$nsprefix)!=$uri))
    {//Remove namespace
     $parent=$this->myDOMNode->ownerElement;
     $parent->removeAttributeNode($this->myDOMNode);
     $parent->setAttribute($this->myDOMNode->localName,$this->myDOMNode->nodeValue);
     $this->myDOMNode=$parent->getAttributeNode($this->myDOMNode->localName);
     return;
    }
    $this->myDOMNode->ownerElement->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns:'.$nsprefix,$uri);
   }
  }
  if ($this->myDOMNode->nodeType==XML_ATTRIBUTE_NODE)
  {
   $parent=$this->myDOMNode->ownerElement;
   $parent->removeAttributeNode($this->myDOMNode);
   $parent->setAttributeNS($uri,$nsprefix.':'.$this->myDOMNode->localName,$this->myDOMNode->nodeValue);
   $this->myDOMNode=$parent->getAttributeNodeNS($uri,$this->myDOMNode->localName);
  }
  elseif ($this->myDOMNode->nodeType==XML_ELEMENT_NODE)
  {
   $NewNode=$this->myDOMNode->ownerDocument->createElementNS($uri,$nsprefix.':'.$this->myDOMNode->localName);
   foreach ($this->myDOMNode->attributes as $n) $NewNode->appendChild($n->cloneNode(true));
   foreach ($this->myDOMNode->childNodes as $n) $NewNode->appendChild($n->cloneNode(true));
   $xpath=new DOMXPath($this->myDOMNode->ownerDocument);
   $myDOMNodeList=$xpath->query('namespace::*[name()!="xml"]',$this->myDOMNode); //Add old namespaces
   foreach ($myDOMNodeList as $n) $NewNode->setAttributeNS('http://www.w3.org/2000/xmlns/',$n->nodeName,$n->nodeValue);
   $this->myDOMNode->parentNode->replaceChild($NewNode,$this->myDOMNode);
   $this->myDOMNode=$NewNode;
  }
 }
 function unlink_node()
 {
  if ($this->myDOMNode->parentNode!=null)
  {
   if ($this->myDOMNode->nodeType==XML_ATTRIBUTE_NODE) $this->myDOMNode->parentNode->removeAttributeNode($this->myDOMNode);
   else $this->myDOMNode->parentNode->removeChild($this->myDOMNode);
  }
 }
 protected function _importNode($newnode) {return $this->myOwnerDocument===$newnode->myOwnerDocument ? $newnode->myDOMNode : $this->myOwnerDocument->myDOMNode->importNode($newnode->myDOMNode,true);} //To import DOMNode from another DOMDocument
 static function _newDOMElement($aDOMNode,$aOwnerDocument)
 {//Check the PHP5 DOMNode before creating a new associated PHP4 DOMNode wrapper
  if ($aDOMNode==null) return null;
  switch ($aDOMNode->nodeType)
  {
   case XML_ELEMENT_NODE: return new php4DOMElement($aDOMNode,$aOwnerDocument);
   case XML_TEXT_NODE: return new php4DOMText($aDOMNode,$aOwnerDocument);
   case XML_ATTRIBUTE_NODE: return new php4DOMAttr($aDOMNode,$aOwnerDocument);
   default: return new php4DOMNode($aDOMNode,$aOwnerDocument);
  }
 }
}

class php4DOMText extends php4DOMNode
{
 function __get($name)
 {
  if ($name=='tagname') return '#text';
  else return parent::__get($name);
 }
 function tagname() {return '#text';}
}

if (!defined('XPATH_NODESET'))
{
 define('XPATH_UNDEFINED',0);
 define('XPATH_NODESET',1);
 /*define('XPATH_BOOLEAN',2);
 define('XPATH_NUMBER',3);
 define('XPATH_STRING',4);
 define('XPATH_POINT',5);
 define('XPATH_RANGE',6);
 define('XPATH_LOCATIONSET',7);
 define('XPATH_USERS',8);
 define('XPATH_XSLT_TREE',9);*/
}

class php4DOMNodelist
{//TODO: To be updated for PHP/5.1 to allow XPath boolean expressions etc. DOMXPath->evaluate()
 private $myDOMNodelist;
 public $nodeset;
 public $type;
 function __construct($aDOMNodelist,$aOwnerDocument)
 {
  $this->myDOMNodelist=$aDOMNodelist;
  $this->nodeset=array();
  $i=0;
  if (isset($this->myDOMNodelist))
  {
   $this->type=XPATH_NODESET;
   while ($node=$this->myDOMNodelist->item($i++)) $this->nodeset[]=php4DOMNode::_newDOMElement($node,$aOwnerDocument);
  }
  else $this->type=XPATH_UNDEFINED;
 }
}

class php4DOMXPath
{
 public $myDOMXPath;
 private $myOwnerDocument;
 function __construct($dom_document)
 {
  //TODO: If $dom_document is a DomElement, make that default $contextnode and modify XPath. Ex: '/test'
  $this->myOwnerDocument=$dom_document->myOwnerDocument;
  $this->myDOMXPath=new DOMXPath($this->myOwnerDocument->myDOMNode);
 }
 function xpath_eval($eval_str,$contextnode=null) {return isset($contextnode) ? new php4DOMNodelist($this->myDOMXPath->query($eval_str,$contextnode->myDOMNode),$this->myOwnerDocument) : new php4DOMNodelist($this->myDOMXPath->query($eval_str),$this->myOwnerDocument);}
 function xpath_register_ns($prefix,$namespaceURI) {return $this->myDOMXPath->registerNamespace($prefix,$namespaceURI);}
}

if (extension_loaded('xsl'))
{//See also: http://alexandre.alapetite.net/doc-alex/xslt-php4-php5/
 function domxml_xslt_stylesheet($xslstring) {return new php4DomXsltStylesheet(DOMDocument::loadXML($xslstring));}
 function domxml_xslt_stylesheet_doc($dom_document) {return new php4DomXsltStylesheet($dom_document);}
 function domxml_xslt_stylesheet_file($xslfile) {return new php4DomXsltStylesheet(DOMDocument::load($xslfile));}
 class php4DomXsltStylesheet
 {
  private $myxsltProcessor;
  function __construct($dom_document)
  {
   $this->myxsltProcessor=new xsltProcessor();
   $this->myxsltProcessor->importStyleSheet($dom_document);
  }
  function process($dom_document,$xslt_parameters=array(),$param_is_xpath=false)
  {
   foreach ($xslt_parameters as $param=>$value) $this->myxsltProcessor->setParameter('',$param,$value);
   $myphp4DOMDocument=new php4DOMDocument();
   $myphp4DOMDocument->myDOMNode=$this->myxsltProcessor->transformToDoc($dom_document->myDOMNode);
   return $myphp4DOMDocument;
  }
  function result_dump_file($dom_document,$filename)
  {
   $html=$dom_document->myDOMNode->saveHTML();
   file_put_contents($filename,$html);
   return $html;
  }
  function result_dump_mem($dom_document) {return $dom_document->myDOMNode->saveHTML();}
 }
}

?>