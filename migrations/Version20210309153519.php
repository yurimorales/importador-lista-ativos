<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309153519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tb_ativos (id INT AUTO_INCREMENT NOT NULL, fk_tipo_uso_id INT DEFAULT NULL, nome VARCHAR(255) DEFAULT NULL, ano INT DEFAULT 2020, descricao_destaque LONGTEXT DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, sugestao_posologica LONGTEXT DEFAULT NULL, link_artigo LONGTEXT NOT NULL, INDEX IDX_FED4D99A52550695 (fk_tipo_uso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_tipo_uso (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tb_ativos ADD CONSTRAINT FK_FED4D99A52550695 FOREIGN KEY (fk_tipo_uso_id) REFERENCES tb_tipo_uso (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_ativos DROP FOREIGN KEY FK_FED4D99A52550695');
        $this->addSql('DROP TABLE tb_ativos');
        $this->addSql('DROP TABLE tb_tipo_uso');
    }
}
