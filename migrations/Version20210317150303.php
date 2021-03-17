<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317150303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_ativos ADD fk_categorias_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tb_ativos ADD CONSTRAINT FK_FED4D99A33D8C7B5 FOREIGN KEY (fk_categorias_id) REFERENCES tb_categorias (id)');
        $this->addSql('CREATE INDEX IDX_FED4D99A33D8C7B5 ON tb_ativos (fk_categorias_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_ativos DROP FOREIGN KEY FK_FED4D99A33D8C7B5');
        $this->addSql('DROP INDEX IDX_FED4D99A33D8C7B5 ON tb_ativos');
        $this->addSql('ALTER TABLE tb_ativos DROP fk_categorias_id');
    }
}
