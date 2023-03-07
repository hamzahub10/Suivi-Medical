<?php

namespace App\Test\Controller;

use App\Entity\Medicament;
use App\Repository\MedicamentRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MedicamentControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MedicamentRepository $repository;
    private string $path = '/medicament/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Medicament::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Medicament index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'medicament[libelle]' => 'Testing',
            'medicament[fabricant]' => 'Testing',
            'medicament[duree_conservation]' => 'Testing',
            'medicament[forme]' => 'Testing',
            'medicament[gamme]' => 'Testing',
            'medicament[medic]' => 'Testing',
        ]);

        self::assertResponseRedirects('/medicament/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Medicament();
        $fixture->setLibelle('My Title');
        $fixture->setFabricant('My Title');
        $fixture->setDuree_conservation('My Title');
        $fixture->setForme('My Title');
        $fixture->setGamme('My Title');
        $fixture->setMedic('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Medicament');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Medicament();
        $fixture->setLibelle('My Title');
        $fixture->setFabricant('My Title');
        $fixture->setDuree_conservation('My Title');
        $fixture->setForme('My Title');
        $fixture->setGamme('My Title');
        $fixture->setMedic('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'medicament[libelle]' => 'Something New',
            'medicament[fabricant]' => 'Something New',
            'medicament[duree_conservation]' => 'Something New',
            'medicament[forme]' => 'Something New',
            'medicament[gamme]' => 'Something New',
            'medicament[medic]' => 'Something New',
        ]);

        self::assertResponseRedirects('/medicament/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getLibelle());
        self::assertSame('Something New', $fixture[0]->getFabricant());
        self::assertSame('Something New', $fixture[0]->getDuree_conservation());
        self::assertSame('Something New', $fixture[0]->getForme());
        self::assertSame('Something New', $fixture[0]->getGamme());
        self::assertSame('Something New', $fixture[0]->getMedic());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Medicament();
        $fixture->setLibelle('My Title');
        $fixture->setFabricant('My Title');
        $fixture->setDuree_conservation('My Title');
        $fixture->setForme('My Title');
        $fixture->setGamme('My Title');
        $fixture->setMedic('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/medicament/');
    }
}
