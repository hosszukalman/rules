<?php

/**
 * @file
 * Contains \Drupal\Tests\rules\Integration\Action\DataListItemRemoveTest.
 */

namespace Drupal\Tests\rules\Integration\Action;

use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\Tests\rules\Integration\RulesIntegrationTestBase;

/**
 * @coversDefaultClass \Drupal\rules\Plugin\Action\DataListItemRemove
 * @group rules_actions
 */
class DataListItemRemoveTest extends RulesIntegrationTestBase {

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

    $this->action = $this->actionManager->createInstance('rules_list_item_remove');
  }

  /**
   * Tests the summary.
   *
   * @covers ::summary()
   */
  public function testSummary() {
    $this->assertEquals('Remove list item', $this->action->summary());
  }

  /**
   * Tests the action execution.
   *
   * @covers ::execute()
   */
  public function testActionExecution() {
    $list = ['One', 'Two', 'Three'];

    $this->action
      ->setContextValue('list', $list)
      ->setContextValue('item', 'Two');

    $this->action->execute();

    // The second item should be removed from the list.
    $this->assertArrayEquals(['One', 'Three'], array_values($this->action->getContextValue('list')));
  }
}
