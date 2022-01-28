<?php
declare (strict_types=1);
namespace MailPoetVendor\Doctrine\ORM\Query;
if (!defined('ABSPATH')) exit;
use MailPoetVendor\Doctrine\ORM\AbstractQuery;
use MailPoetVendor\Doctrine\ORM\Mapping\ClassMetadata;
interface TreeWalker
{
 public function __construct($query, $parserResult, array $queryComponents);
 public function getQueryComponents();
 public function setQueryComponent($dqlAlias, array $queryComponent);
 public function walkSelectStatement(AST\SelectStatement $AST);
 public function walkSelectClause($selectClause);
 public function walkFromClause($fromClause);
 public function walkFunction($function);
 public function walkOrderByClause($orderByClause);
 public function walkOrderByItem($orderByItem);
 public function walkHavingClause($havingClause);
 public function walkJoin($join);
 public function walkSelectExpression($selectExpression);
 public function walkQuantifiedExpression($qExpr);
 public function walkSubselect($subselect);
 public function walkSubselectFromClause($subselectFromClause);
 public function walkSimpleSelectClause($simpleSelectClause);
 public function walkSimpleSelectExpression($simpleSelectExpression);
 public function walkAggregateExpression($aggExpression);
 public function walkGroupByClause($groupByClause);
 public function walkGroupByItem($groupByItem);
 public function walkUpdateStatement(AST\UpdateStatement $AST);
 public function walkDeleteStatement(AST\DeleteStatement $AST);
 public function walkDeleteClause(AST\DeleteClause $deleteClause);
 public function walkUpdateClause($updateClause);
 public function walkUpdateItem($updateItem);
 public function walkWhereClause($whereClause);
 public function walkConditionalExpression($condExpr);
 public function walkConditionalTerm($condTerm);
 public function walkConditionalFactor($factor);
 public function walkConditionalPrimary($primary);
 public function walkExistsExpression($existsExpr);
 public function walkCollectionMemberExpression($collMemberExpr);
 public function walkEmptyCollectionComparisonExpression($emptyCollCompExpr);
 public function walkNullComparisonExpression($nullCompExpr);
 public function walkInExpression($inExpr);
 public function walkInstanceOfExpression($instanceOfExpr);
 public function walkLiteral($literal);
 public function walkBetweenExpression($betweenExpr);
 public function walkLikeExpression($likeExpr);
 public function walkStateFieldPathExpression($stateFieldPathExpression);
 public function walkComparisonExpression($compExpr);
 public function walkInputParameter($inputParam);
 public function walkArithmeticExpression($arithmeticExpr);
 public function walkArithmeticTerm($term);
 public function walkStringPrimary($stringPrimary);
 public function walkArithmeticFactor($factor);
 public function walkSimpleArithmeticExpression($simpleArithmeticExpr);
 public function walkPathExpression($pathExpr);
 public function walkResultVariable($resultVariable);
 public function getExecutor($AST);
}
