<?php

namespace Imavia\FacetProfileBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Claroline\CoreBundle\Library\Installation\BundleMigration;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130319135624 extends BundleMigration
{
    public function up(Schema $schema)
    {
        $this->createImaviaUserCommentTable($schema);
        $this->createImaviaScaleTable($schema);
        $this->createImaviaAttributeValueTable($schema);
        $this->createImaviaAttributeTable($schema);
        $this->createImaviaComponentTable($schema);
        $this->createImaviaFacetTable($schema);
        $this->createImaviaProfileTable($schema);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('imavia_usercomment');
        $schema->dropTable('imavia_scale');
        $schema->dropTable('imavia_attributevalue');
        $schema->dropTable('imavia_attribute');
        $schema->dropTable('imavia_component');
        $schema->dropTable('imavia_facet');
        $schema->dropTable('imavia_profile');
    }
    
    private function createImaviaProfileTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_profile');
        $this->addId($table);
        $this->storeTable($table);
    }
    
    private function createImaviaFacetTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_facet');
        $this->addId($table);
        $table->addColumn('description', 'text');
        $table->addColumn('name', 'string', array('length' => 255));
        $table->addColumn('creationdate', 'datetime');
        $table->addColumn('lastmodificationdate', 'datetime');
        
        $table->addColumn('profile', 'integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_profile'),
            array('profile'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex(array('profile'));
       
        
        $this->storeTable($table);
    }
    
        
    private function createImaviaComponentTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_component');
        $this->addId($table);
        $table->addColumn('description', 'text');
        $table->addColumn('name', 'string', array('length' => 255));
        $table->addColumn('creationdate', 'datetime');
        $table->addColumn('lastmodificationdate', 'datetime');
        $table->addColumn('facet', 'integer');
        
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_facet'),
            array('facet'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex(array('profile'));
        
        
        $table->addColumn('comment', 'integer');
       
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comment'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex(array('comment'));
        $this->storeTable($table);
    }
    
        
    private function createImaviaAttributeTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_attribute');
        $this->addId($table);
        $table->addColumn('description', 'text');
        $table->addColumn('name', 'string', array('length' => 255));
        $table->addColumn('creationdate', 'datetime');
        $table->addColumn('lastmodificationdate', 'datetime');
       
        $table->addColumn('component', 'integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_component'),
            array('component'),
            array('id'),
            array('onDelete'  => 'CASCADE')
        );
         $table->addUniqueIndex(array('comment'));
        
    
        $table->addColumn('comment', 'integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comment'),
            array('id'),
            array('onDelete'  => 'CASCADE')
        );
         $table->addUniqueIndex(array('comment'));
        
        $this->storeTable($table);
    }
    
    private function createImaviaAttributeValueTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_attributevalue');
        $this->addId($table);
        
        $table->addColumn('evaluationdate', 'datetime');
        $table->addColumn('value', 'string', array('length' => 255));
        $table->addColumn('description', 'text');
        $table->addColumn('name', 'string', array('length' => 255));
        $table->addColumn('creationdate', 'datetime');
        $table->addColumn('lastmodificationdate', 'datetime');
        $table->addColumn('attribute', 'integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_attribute'),
            array('attribute'),
            array('id'),
            array('onDelete'  => 'CASCADE')
        );
        $table->addUniqueIndex(array('scale_id'));
        
        $table->addColumn('scale_id', 'integer');
      
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_scale'),
            array('scale_id'),
            array('id'),
            array('onDelete'  => 'CASCADE')
        );
        $table->addUniqueIndex(array('scale_id'));
        
        $table->addColumn('comment', 'integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comment'),
            array('id'),
            array('onDelete'  => 'CASCADE')
        );
         $table->addUniqueIndex(array('comment'));
        
        $this->storeTable($table);
    }
    
    private function createImaviaScaleTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_scale');
        $this->addId($table);
        $table->addColumn('description', 'text');
        $table->addColumn('date', 'datetime');
        $table->addColumn('minval', 'integer');
        $table->addColumn('maxval', 'integer');
        $this->storeTable($table);
    }
     
    private function createImaviaUserCommentTable(Schema $schema)
    {
        $table = $schema->createTable('imavia_usercomment');
        $this->addId($table);
        $table->addColumn('commentcontent', 'text');
        $table->addColumn('emissiondate', 'datetime');
        $this->storeTable($table);
    }
}
