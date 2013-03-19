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
      $this->createImaviaProfileTable($schema);
      $this->createImaviaFacetTable($schema);
      $this->createImaviaComponentTable($schema);
      $this->createImaviaAttributeTable($schema);
      $this->createImaviaAttributeValueTable($schema);
      $this->createImaviaScaleTable($schema);
      $this->createImaviaUserCommentTable($schema);
    }

    public function down(Schema $schema)
    {
       $schema->dropTable('imavia_profile'); 
       $schema->dropTable('imavia_facet');
       $schema->dropTable('imavia_component');
       $schema->dropTable('imavia_attribute');
       $schema->dropTable('imavia_attributevalue');
       $schema->dropTable('imavia_scale');
       $schema->dropTable('imavia_usercomment');
     }
    
    private function createImaviaProfileTable(Schema $schema)
    {
        
        $table=$schema->createTable('imavia_profile');
        $this->addId($table);
        $table->addColumn('facets_id','integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_facet'),
            array('facets_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('facets_id');
        $this->storeTable($table);
        
    }
    
    private function createImaviaFacetTable(Schema $schema)
    {
        $table=$schema->createTable('imavia_facet');
        $this->addId($table);
        $table->addColumn('description','text');
        $table->addColumn('name','string',array('length'=>255));
        $table->addColumn('creationdate','datetime');
        $table->addColumn('lastmodificationdate','datetime');
        $table->addColumn('components_id','integer');
        $table->addColumn('comments_id','integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_component'),
            array('components_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
         $table->addUniqueIndex('components_id');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comments_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
         $table->addUniqueIndex('comments_id');
        $this->storeTable($table);
    }
    
        
    private function createImaviaComponentTable(Schema $schema)
    {
        $table=$schema->createTable('imavia_component');
        $this->addId($table);
        $table->addColumn('description','text');
        $table->addColumn('name','string',array('length'=>255));
        $table->addColumn('creationdate','datetime');
        $table->addColumn('lastmodificationdate','datetime');
        $table->addColumn('attributes_id','integer');
        $table->addColumn('comments_id','integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_attribute'),
            array('attributes_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('attributes_id');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comments_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('comments_id');
        $table->setPrimaryKey('id');
        $this->storeTable($table);
    }
    
        
    private function createImaviaAttributeTable(Schema $schema)
    {
        $table=$schema->createTable('imavia_attribute');
        $this->addId($table);
        $table->addColumn('description','text');
        $table->addColumn('name','string',array('length'=>255));
        $table->addColumn('creationdate','datetime');
        $table->addColumn('lastmodificationdate','datetime');
        $table->addColumn('values_id','integer');
        $table->addColumn('comments_id','integer');
        
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_attributevalue'),
            array('values_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('values_id');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comments_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('comments_id');
        
        $this->storeTable($table);
    }
    
        private function createImaviaAttributeValueTable(Schema $schema)
    {
        $table=$schema->createTable('imavia_attributevalue');
        $this->addId($table);
        
        $table->addColumn('evaluationdate','datetime');
        $table->addColumn('value','string',array('length'=>255));
        $table->addColumn('description','text');
        $table->addColumn('name','string',array('length'=>255));
        $table->addColumn('creationdate','datetime');
        $table->addColumn('lastmodificationdate','datetime');
        $table->addColumn('scale_id','integer');
        $table->addColumn('comments_id','integer');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_scale'),
            array('scale_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('idscale_id');
        $table->addForeignKeyConstraint(
            $schema->getTable('imavia_usercomment'),
            array('comments_id'),
            array('id'),
            array('onDelete' => 'CASCADE')
        );
        $table->addUniqueIndex('comments_id');
        $this->storeTable($table);
    }
    
     private function createImaviaScaleTable(Schema $schema)
    {
        $table=$schema->createTable('imavia_scale');
        $this->addId($table);
        $table->addColumn('description','text');
        $table->addColumn('date','datetime');
        $table->addColumn('minvalue','integer');
        $table->addColumn('maxvalue','integer');
        $this->storeTable($table);
    }
     
    private function createImaviaUserCommentTable(Schema $schema)
    {
        $table=$schema->createTable('imavia_usercomment');
        $this->addId($table);
        $table->addColumn('commentcontent','text');
        $table->addColumn('emissiondate','datetime');
        $this->storeTable($table);
    }
    
    
}
