<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402130649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_has_users (user INT NOT NULL, users INT NOT NULL, INDEX IDX_EFEA38B38D93D649 (user), INDEX IDX_EFEA38B31483A5E9 (users), PRIMARY KEY(user, users)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_has_users ADD CONSTRAINT FK_EFEA38B38D93D649 FOREIGN KEY (user) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE user_has_users ADD CONSTRAINT FK_EFEA38B31483A5E9 FOREIGN KEY (users) REFERENCES fos_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_has_users');
    }
}
