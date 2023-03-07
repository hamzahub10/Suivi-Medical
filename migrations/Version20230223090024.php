<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223090024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordonnance_medicament (ordonnance_id INT NOT NULL, medicament_id INT NOT NULL, INDEX IDX_FE7DFAEE2BF23B8F (ordonnance_id), INDEX IDX_FE7DFAEEAB0D61F7 (medicament_id), PRIMARY KEY(ordonnance_id, medicament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordonnance_medicament ADD CONSTRAINT FK_FE7DFAEE2BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordonnance_medicament ADD CONSTRAINT FK_FE7DFAEEAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation ADD consul_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A65D16829 FOREIGN KEY (consul_id) REFERENCES rdv (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_964685A65D16829 ON consultation (consul_id)');
        $this->addSql('ALTER TABLE ordonnance ADD ord_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CED9CBB9E FOREIGN KEY (ord_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_924B326CED9CBB9E ON ordonnance (ord_user_id)');
        $this->addSql('ALTER TABLE rdv ADD rdv_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F862078A90A FOREIGN KEY (rdv_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_10C31F862078A90A ON rdv (rdv_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordonnance_medicament DROP FOREIGN KEY FK_FE7DFAEE2BF23B8F');
        $this->addSql('ALTER TABLE ordonnance_medicament DROP FOREIGN KEY FK_FE7DFAEEAB0D61F7');
        $this->addSql('DROP TABLE ordonnance_medicament');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A65D16829');
        $this->addSql('DROP INDEX UNIQ_964685A65D16829 ON consultation');
        $this->addSql('ALTER TABLE consultation DROP consul_id');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CED9CBB9E');
        $this->addSql('DROP INDEX IDX_924B326CED9CBB9E ON ordonnance');
        $this->addSql('ALTER TABLE ordonnance DROP ord_user_id');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F862078A90A');
        $this->addSql('DROP INDEX IDX_10C31F862078A90A ON rdv');
        $this->addSql('ALTER TABLE rdv DROP rdv_user_id');
    }
}
