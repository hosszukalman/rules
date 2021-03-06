<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Unit\Action\EntityDeleteTest.
 */

namespace Drupal\Tests\rules\Unit\Action;

use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\rules\Plugin\Action\EntityDelete;
use Drupal\Tests\rules\Unit\RulesUnitTestBase;

/**
 * @coversDefaultClass \Drupal\rules\Plugin\Action\EntityDelete
 * @group rules_action
 */
class EntityDeleteTest extends RulesUnitTestBase {

  /**
   * The action to be tested.
   *
   * @var \Drupal\rules\Engine\RulesActionInterface
   */
  protected $action;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->action = new EntityDelete([], '', ['context' => [
      'entity' => new ContextDefinition('entity'),
    ]]);

    $this->action->setStringTranslation($this->getMockStringTranslation());
    $this->action->setTypedDataManager($this->getMockTypedDataManager());
  }

  /**
   * Tests the summary.
   *
   * @covers ::summary()
   */
  public function testSummary() {
    $this->assertEquals('Delete entity', $this->action->summary());
  }

  /**
   * Tests the action execution.
   *
   * @covers ::execute()
   */
  public function testActionExecution() {
    $entity = $this->getMock('Drupal\Core\Entity\EntityInterface');
    $entity->expects($this->once())
      ->method('delete');

    $this->action->setContextValue('entity', $this->getMockTypedData($entity));
    $this->action->execute();
  }

}
